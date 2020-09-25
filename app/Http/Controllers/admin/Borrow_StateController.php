<?php

namespace App\Http\Controllers\admin;

use App\Borrow_State;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Borrow_StateController extends Controller
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
        $borrow_states = Borrow_State::all();
        return view('admin_panel.borrow_states.index',compact('borrow_states'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin_panel.borrow_states.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255']
        ]);

        Borrow_State::create($data);
        return redirect()->route('borrow_state.index');
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
        $borrow_state = Borrow_State::find($id);
        return view('admin_panel.borrow_states.edit',compact('borrow_state'));
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
        $borrow_state = Borrow_State::find($id);
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255']
        ]);
        $borrow_state->name = $data['name'];
        $borrow_state->save();
        return redirect()->route('borrow_state.index');
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
