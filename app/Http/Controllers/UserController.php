<?php

namespace App\Http\Controllers;

use App\Author;
use App\Borrow;
use App\Extend_Borrowing;
use App\Favorite;
use App\File;
use App\Http\Requests\Request_to_add_item_user;
use App\Item;
use App\Item_Author;
use App\Item_State;
use App\Item_Type;
use App\Maintainer;
use App\Site_Setting;
use App\Subject;
use App\Tag;
use App\Tag_Item;
use App\traits\helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;



class UserController extends Controller
{

    use helper;

    public function __construct()
    {
        $this->middleware(['auth','is_active']);
    }

    public function show_add_item_project_request()
    {
        $maintainers = Maintainer::all();
        $subjects = Subject::all();

        $tags = Tag::all();

        return view('user.home.add_item_project',compact('maintainers','subjects','tags'));
    }


    public function store_item_project_request(Request_to_add_item_user $request)
    {
        // upload files to server
    
        $item_type = 2; // project always

        DB::beginTransaction();

        $item = Item::create([
            'name'=>$request['name'],
            'desc'=>$request['desc'],
            'subject_id'=>$request['subject_id'],
            'item_state_id'=> 1 , // Available
            'item_type_id'=> $item_type ,
            'maintainer_id'=> $request['maintainer_id'],
            'is_active' => 0,
        ]);

        if(!$item)
        {
            DB::rollback();
            return back()->with('message','لم تم اضافة هذا العنصر');

        }
        else
        {
            DB::commit();

            DB::beginTransaction();

            try{

                if ($request->myfiles != null)
            {
                foreach ($request->myfiles as $file)
                {
                    $type = $this->getTypeOfFile($file);
                    if($type != 'not supported')
                    {
                        $fileName = time().'.'.$file -> getClientOriginalExtension();
                        $path ='item_files/'.$type;
                        $file -> move($path,$fileName);
    
                        File::create([
                            'item_id'=> $item->id,
                            'name' => $fileName,
                            'type'=> $type
                        ]);
    
                    }
    
                }
            }
    
            if ($request->tag_id != null)
            {
                foreach ($request->tag_id as $tag_id)
                {
                    Tag_Item::create([
                        'item_id' => $item->id,
                        'tag_id' => $tag_id
                    ]);
                }
            }
    
    
            $author_first_name = Auth::user()->first_name;
            $author_last_name = Auth::user()->last_name;
    
    
            $author = Author::create([
                'first_name' => $author_first_name,
                'last_name'=> $author_last_name
            ]);
    
            Item_Author::create([
               'item_id' => $item->id,
               'author_id' => $author->id,
            ]);
            


                DB::commit();
                return redirect()->route('home');
            }
            catch(\Exception $e)
            {
                DB::rollback();
                return back()->with('message','لم تم اضافة هذا العنصر');
            }

            

        }


       
    }


    public function show_my_borrows_and_reservations()
    {
        $borrows = Auth::user()->getmyBorrows();
        $reservations = Auth::user()->getmyReservation();


        return view('user.home.myBorrows',compact('borrows','reservations'));
    }

    public function add_item_to_favorite($id)
    {

        DB::beginTransaction();

        $isFavorite = Auth::user()->isFavorite($id);
        

        if ($isFavorite) // cancel favorite
        {
            $f = $isFavorite->delete();
            if(!$f)
            {
                DB::rollback();
            }
            else
            {
                DB::commit();
                return back()->with('message','تم ازالة هذا العنصر من المفضلة');
            }
        }
        else // add favorite
        {
            $f = Favorite::create([
                'item_id' => $id,
                'user_id' => Auth::user()->id,
            ]);

            if(!$f)
            {
                DB::rollback();
            }
            else
            {
                DB::commit();
                return back()->with('message','تم اضافة هذا العنصر للمفضلة');
            }

        }

    }

    public function add_item_to_reservation($id)
    {

        $isReservation = Auth::user()->isReservation($id);

        if ($isReservation) // cancel reservation
        {
            // make item avilable
            $item = Item::find($id);
            $item->item_state_id = 1;
            $item -> save();

            // set Borrow as cancelled by user
            $reservation = Auth::user()->getReservation($id);
            $reservation -> borrow_state_id = 8;
            $reservation -> save();

            $num_day_cancel_reservation = Site_Setting::where(['name'=>'num_day_cancel_reservation'])->first();
            $int = (int)$num_day_cancel_reservation->value;

            $count = count(Auth::user()->getCancelled_Reservation($id));

            $time = $int-$count;

            return back()->with('message',"لقد تم إلغاء حجز العنصر بنجاح , تبقى لك  $time مرات اعتذار");

        }
        else // add reservation
        {
            $num_day_cancel_reservation = Site_Setting::where(['name'=>'num_day_cancel_reservation'])->first();
            $int = (int)$num_day_cancel_reservation->value;

            $count = count(Auth::user()->getCancelled_Reservation());

            if ($count >= $int)
            {
                return back()->with('message','لقد تجاوزت عدد مرات الحجز و الاعتذار عن حجز');
            }
            else
            {
                $item = Item::find($id);
                $item->item_state_id = 4;
                $item -> save();

                $now = date('y-m-d');
                $now2 = \Carbon\Carbon::createFromFormat('y-m-d',$now);
                $num_day_reservation = Site_Setting::where(['name'=>'num_day_reservation'])->first();
                $int2 = (int)$num_day_reservation->value;


                Borrow::create([
                    'item_id'=>$id,
                    'user_id'=> Auth::user()->id,
                    'borrow_state_id'=> 1,
                    'return_date' =>  $now2->addDays($int2)
                ]);

                return back()->with('message','لقد تم حجز العنصر بنجاح');
            }
        }

    }


    public function extend_borrow($id)
    {
        $borrow =Borrow::find($id);
        return view('user.home.extend_borrow',compact('borrow'));
    }

    public function store_extend_borrow(Request $request)
    {
        Extend_Borrowing::create([
            'user_id'=> Auth::user()->id ,
            'borrow_id'=> $request->borrow_id ,
            'day'=> $request->day
        ]);
        return redirect()->route('user.borrows.show');
    }

    public function download_file($id)
    {
        $file = File::find($id);
        $file_path = 'item_files\\'.$file->type.'\\'.$file->name;
        return response()->download($file_path);
    }


}
