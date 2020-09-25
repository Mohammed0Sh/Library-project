<?php

namespace App\Http\Controllers\admin;

use App\Borrow;
use App\Borrow_State;
use App\Extend_Borrowing;
use App\Http\Controllers\Controller;
use App\Item;
use App\Site_Setting;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BorrowController extends Controller
{



    public function __construct()
    {
        $this->middleware(['admin_auth','is_active']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $borrows = Borrow::all();
        $borrow_States = Borrow_State::all();
        return view('admin_panel.borrows.index',compact('borrow_States','borrows'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function setItem()
    {
        $items = Item::where('is_active',1)->get();
        return view('admin_panel.borrows.setItem',compact('items'));
    }

    public function setUser(Request $request)
    {
        $item_id = $request['item_id'];
        $users = User::all();
        return view('admin_panel.borrows.setuser',compact('users','item_id'));
    }


    public function create()
    {
        $borrow_States = Borrow_State::all();
        return view('admin_panel.borrows.create',compact('borrow_States'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $num_day = Site_Setting::where(['name'=>'num_day_borrow'])->first();

        $current = Carbon::now();
        $int = (int)$num_day->value;
        $trialExpires = $current->addDays($int);

        $borrow = Borrow::where(['item_id'=>$request['item_id']])->first();
        if ($borrow == null)
        {
            $borrow = Borrow::create([
                'item_id'=>$request['item_id'],
                'user_id'=>$request['user_id'],
                'borrow_state_id'=>3,
                'return_date'=> $trialExpires
            ]);

            $item = $borrow->getItem;
            $item->item_state_id = 3;
            $item->save();

        }
        else
        {
            if ($borrow->user_id == $request['user_id'])
            {
                $borrow->borrow_state_id = 3;
                $borrow->user_id = $request['user_id'];
                $borrow->return_date = $trialExpires;
                $borrow->save();
                $item = $borrow->getItem;
                $item->item_state_id = 3;
                $item->save();
            }
            else
            {
                $borrow->borrow_state_id = 6;
                $borrow->save();


                $newborrow = Borrow::create([
                    'item_id'=>$request['item_id'],
                    'user_id'=>$request['user_id'],
                    'borrow_state_id'=>3,
                    'return_date'=> $trialExpires
                ]);

                $item = $newborrow->getItem;
                $item->item_state_id = 3;
                $item->save();
            }

        }





        return redirect()->route('borrow.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $borrow = Borrow::find($id);
        return view('admin_panel.borrows.edit',compact('borrow'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $borrow =Borrow::find($id);
        $borrow->return_date = $request['return_date'];
        $borrow->save();

        return redirect()->route('borrow.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function cansel_reservation(Request $request)
    {
        $borrow = Borrow::find($request['borrow_id']);
        $item = $borrow->getItem;
        $borrow->borrow_state_id = 6;
        $borrow->save();
        $item->item_state_id = 1;
        $item->save();
        return redirect()->route('borrow.index');
    }

    public function show_extend_borrows_requsets()
    {
        $extend_borrows = Extend_Borrowing::all();
        return view('admin_panel.borrows.extend_borrows_requests',compact('extend_borrows'));
    }

    public function accept_extend_borrow($id)
    {
        $extend_borrow = Extend_Borrowing::find($id);
        $borrow = $extend_borrow -> getBorrow;

        $new_date = strtotime($borrow ->return_date."+ $extend_borrow->day days");
        $new_date = date("Y-m-d",$new_date);

        $borrow ->return_date = $new_date;
        $borrow -> save();

        $extend_borrow -> delete();
        return back();
    }

    public function rejection_extend_borrow($id)
    {
        Extend_Borrowing::find($id)->delete();
        return back();
    }



}
