<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Maintainer;
use Illuminate\Http\Request;

class MaintainerController extends Controller
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
        $maintainers = Maintainer::all();
        return view('admin_panel.maintainer.index',compact('maintainers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin_panel.maintainer.create');
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
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:maintainers'],
            'mobile'=> ['required','numeric','min:10']
        ]);

        Maintainer::create($data);

        return  redirect()->route('maintainer.index');
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
        $maintainer = Maintainer::find($id);
        return view('admin_panel.maintainer.edit',compact('maintainer'));
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
        $maintainer = Maintainer::find($id);
        $maintainer->email='';
        $maintainer->save();

        $data = $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:maintainers'],
            'mobile'=> ['required','numeric','min:10']
        ]);
        $maintainer->first_name = $data['first_name'];
        $maintainer->last_name = $data['last_name'];
        $maintainer->email = $data['email'];
        $maintainer->mobile = $data['mobile'];
        $maintainer->save();

        return  redirect()->route('maintainer.index');
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
