<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Item_State;
use Illuminate\Http\Request;

class Item_StateController extends Controller
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
        $item_states = Item_State::all();
        return view('admin_panel.item_states.index',compact('item_states'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin_panel.item_states.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $date = $request->validate([
            'name' => ['required', 'string', 'max:255']
        ]);
        Item_State::create($date);
        return redirect()->route('item_state.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item_state = Item_State::find($id);
        return view('admin_panel.item_states.edit',compact('item_state'));
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
        $item_state = Item_State::find($id);
        $date = $request->validate([
            'name' => ['required', 'string', 'max:255']
        ]);
        $item_state->name = $date['name'];
        $item_state->save();
        return redirect()->route('item_state.index');

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
}
