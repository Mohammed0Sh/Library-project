<?php

namespace App\Http\Controllers\admin;

use App\Academic_Year;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Academic_YearController extends Controller
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
        $academic_years = Academic_Year::all();
        return view('admin_panel.academic_years.index',compact('academic_years'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin_panel.academic_years.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Academic_Year::create(['name'=>$request->name]);
        return redirect()->route('academic_year.index');
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
        $academic_year = Academic_Year::find($id);
        return view('admin_panel.academic_years.edit',compact('academic_year'));
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
        $academic_year = Academic_Year::find($id);
        $academic_year->name = $request->name;
        $academic_year->save();
        return redirect()->route('academic_year.index');
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
