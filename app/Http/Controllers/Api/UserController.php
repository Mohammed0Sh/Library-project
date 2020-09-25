<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Favorite;
use App\Item;
use App\Site_Setting;
use App\Borrow;
use  App\Maintainer;
use  App\Subject;
use  App\Tag;
use App\File;
use App\User;
use App\Extend_Borrowing;

use http\Env\Response;

class UserController extends Controller
{
    //

    public function add_item_to_favorite()
    {

        $isFavorite = \request()->user()->isFavorite(\request('id'));


        if ($isFavorite != null) // cancel favorite
        {
            $isFavorite->delete();
            return response()->json(['status'=>false]);
        }
        else // add favorite
        {
           Favorite::create([
                'item_id' =>(int)request('id'),
                'user_id' => request()->user()->id,
            ]);
            return response()->json(['status'=>true]);
        }

    }

    public  function getReservationDetile(){

        $item = Item::find((int)\request('id'));

        return response()->json($item);

    }

    public function add_item_to_reservation()
    {

        $isReservation = \request()->user()->isReservation((int)\request('id'));

        if ($isReservation) // cancel reservation
        {
            // make item avilable
            $item = Item::find((int)\request('id'));
            $item->item_state_id = 1;
            $item -> save();

            // set Borrow as cancelled by user
            $reservation = \request()->user()->getReservation((int)\request('id'));
            $reservation -> borrow_state_id = 8;
            $reservation -> save();

            $num_day_cancel_reservation = Site_Setting::where(['name'=>'num_day_cancel_reservation'])->first();
            $int = (int)$num_day_cancel_reservation->value;

            $count = count(\request()->user()->getCancelled_Reservation((int)\request('id')));

            $time = $int-$count;

            return response()->json(['status'=>false,'message'=>'تم الغاء الحجز بنجاح']);

        }
        else // add reservation
        {
            $num_day_cancel_reservation = Site_Setting::where(['name'=>'num_day_cancel_reservation'])->first();
            $int = (int)$num_day_cancel_reservation->value;

            $count = count(\request()->user()->getCancelled_Reservation());

            if ($count >= $int)
            {
                return response()->json(['status'=>false,'message'=>'لقد تجاوزت عدد مرات الحجز و الاعتذار عن حجز']);
            }
            else
            {
                $item = Item::find((int)\request('id'));
                $item->item_state_id = 4;
                $item -> save();

                $now = date('y-m-d');
                $now2 = \Carbon\Carbon::createFromFormat('y-m-d',$now);
                $num_day_reservation = Site_Setting::where(['name'=>'num_day_reservation'])->first();
                $int2 = (int)$num_day_reservation->value;

                Borrow::create([

                    'item_id'=>(int)\request('id'),
                    'user_id'=> \request()->user()->id,
                    'borrow_state_id'=> 1,
                    'return_date' => $now2->addDays($int2)
                ]);

                return response()->json(['status'=>true,'message'=>'تم الحجز بنجاح']);
            }
        }

    }

    public function getFavorate(){

        $user =\request()->user();
        $favorats= $user->getFavorites;
        $result=[];
        foreach($favorats as $favorate){
            $result[count($result)]= Item::find($favorate['item_id']) ;
        }
        foreach($result as $r){
            $r['isFavorate']=true;
            if($r['id']== $r->item_id)
            $r['isReservation']=true;
            else 
            $r['isReservation']=false;
        }
    
        return response()->json($result);
    }

    public function show_my_borrows()
    {


      $borrows= Borrow::select()->with('getItem')
        ->where('user_id', \request()->user()->id)
        ->where('borrow_state_id',3)->get();


        return response()->json($borrows);
    }
    public function show_my_reservations()
    {

        $borrows =   $borrows= Borrow::select()->with('getItem')
        ->where('user_id', \request()->user()->id)
        ->where('borrow_state_id',1)->get();
        return response()->json($borrows);
    }


    public function show_add_item_project_request()
    {
        $maintainers = Maintainer::all();
        $subjects = Subject::all();

        $tags = Tag::all();

        return response()->json(['maintainers'=>  $maintainers,'subjects'=>$subjects,'tags'=> $tags]);
    }

    public function store_item_project_request()
    {
        // upload files to server

        $item_type = 2; // project always


        $item = Item::create([
            'name'=>$request['name'],
            'desc'=>$request['desc'],
            'subject_id'=>$request['subject_id'],
            'item_state_id'=> 1 , // Available
            'item_type_id'=> $item_type ,
            'maintainer_id'=> $request['maintainer_id'],
            'is_active' => 0,
        ]);


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



        return redirect()->route('home');
    }




    public function store_extend_borrow()
    {
      $res = request()->user()->hasExtend_Borrowing_on_borrow((int)request('borrow_id'));
      if(!$res)
      {
        Extend_Borrowing::create([
            'user_id'=> request()->user()->id ,
            'borrow_id'=>(int) request('borrow_id') ,
            'day'=> (int) request('day')
        ]);
        return response()->json(['status'=>true]);
      }else
      return response()->json(['status'=>false]);
    }

}
