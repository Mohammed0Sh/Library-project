<?php

namespace App\Http\Controllers\admin;

use App\Academic_Year;
use App\Http\Controllers\Controller;
use App\Specialize;
use App\Subject;
use Illuminate\Http\Request;
use function Sodium\compare;

class SubjectController extends Controller
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
        $subjects = Subject::all();
        return view('admin_panel.subjects.index',compact('subjects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $academic_years = Academic_Year::pluck('name','id');
        $specializes = Specialize::pluck('name','id');
        return view('admin_panel.subjects.create',compact('academic_years','specializes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

         Subject::create([
             'name'=>$request->name,
             'specialize_id'=>$request->specialize,
             'academic_year_id'=>$request->academic_year
         ]);
        return redirect()->route("subject.index");
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
        $subject = Subject::find($id);
        $academic_years = Academic_Year::pluck('name','id');
        $specializes = Specialize::pluck('name','id');
        return view('admin_panel.subjects.edit',compact('subject','specializes','academic_years'));
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
        $subject = Subject::find($id);
        $subject->name = $request->name;
        $subject->specialize_id = $request->specialize;
        $subject->academic_year_id = $request->academic_year;
        $subject->save();
        return redirect()->route("subject.index");
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
