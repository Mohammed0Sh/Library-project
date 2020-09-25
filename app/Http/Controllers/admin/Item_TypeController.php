<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Item_Type;
use Illuminate\Http\Request;

class Item_TypeController extends Controller
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
        $item_types = Item_Type::all();
        return view('admin_panel.item_types.index',compact('item_types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin_panel.item_types.create');
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
        Item_Type::create($date);
        return redirect()->route('item_type.index');
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
        $item_type = Item_Type::find($id);

        return view('admin_panel.item_types.edit',compact('item_type'));

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
        $item_type = Item_Type::find($id);
        $date = $request->validate([
            'name' => ['required', 'string', 'max:255']
        ]);
        $item_type->name = $date['name'];
        $item_type->save();
        return redirect()->route('item_type.index');
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
