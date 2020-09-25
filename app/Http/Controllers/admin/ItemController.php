<?php

namespace App\Http\Controllers\admin;

use App\Author;
use App\Http\Controllers\Controller;
use App\Item;
use App\Item_Author;
use App\Item_State;
use App\Item_Type;
use App\Maintainer;
use App\Subject;
use App\Tag;
use App\Tag_Item;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Array_;
use phpDocumentor\Reflection\Types\This;
use function GuzzleHttp\Promise\all;
use Illuminate\Support\Facades\File;

class ItemController extends Controller
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
        $items = Item::all();
        return view('admin_panel.items.index',compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $maintainers = Maintainer::all();
        $item_types = Item_Type::all();
        $subjects = Subject::all();
        $item_states = Item_State::all();
        return view('admin_panel.items.create',compact('item_types','item_states','maintainers','subjects'));
    }

    public function tosetAuthor(Request $request)
    {

        $item = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'desc' => ['required', 'string', 'max:255'],
            'subject_id' => ['required'],
            'item_state_id' => ['required'],
            'item_type_id' => ['required'],
            'maintainer_id' => ['required'],
        ]);
        $authors = Author::all();

        return view('admin_panel.items.setAuthor',compact('authors','item'));
    }

    public function tosetTag(Request $request)
    {
        //return $request->all();
        $oldauthors = null;
        $item = [
            'name'=>$request['name'],
            'desc'=>$request['desc'],
            'subject_id'=>$request['subject_id'],
            'item_state_id'=>$request['item_state_id'],
            'item_type_id'=>$request['item_type_id'],
            'maintainer_id'=>$request['maintainer_id'],
        ];

        $newauthors = [];
        if ( $request->has('first_name') )
        {

            for ($i = 0 ; $i < count($request['first_name']) ; $i++ )
            {
                $newauthors[$i] =[

                        'first_name'=> $request['first_name'][$i],
                        'last_name' => $request['last_name'][$i],
                        'mobile' => $request['mobile'][$i],

                ];
            }
        }



        if ($request->has('author_id') )
        {

            $oldauthors = $request['author_id'];

        }

        $tags = Tag::all();


        return view('admin_panel.items.setTag',compact('tags','oldauthors','item','newauthors'));



    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //return $request->all();

        $item = [
            'name'=>$request['name'],
            'desc'=>$request['desc'],
            'subject_id'=>$request['subject_id'],
            'item_state_id'=>$request['item_state_id'],
            'item_type_id'=>$request['item_type_id'],
            'maintainer_id'=>$request['maintainer_id'],
            'is_active' => 1,
        ];

        $author_ids=[];
        if ( $request->has('first_name') )
        {
            $newauthors = [];
            for ($i = 0 ; $i < count($request['first_name']) ; $i++ )
            {
                $newauthors[$i] =[

                    'first_name'=> $request['first_name'][$i],
                    'last_name' => $request['last_name'][$i],
                    'mobile' => $request['mobile'][$i],

                ];
                $author = Author::create($newauthors[$i]);
                $author_ids[count($author_ids)] = $author->id;
            }

        }


        if ($request->has('oldauthor') )
        {
            $oldauthors = [];
            $oldauthors = $request['oldauthor'];
            foreach ($oldauthors as $oldauthor)
            {
                $author_ids[count($author_ids)] = intval($oldauthor);
            }
        }



        $tag_ids = [];
        if ( $request->has('tag_name') )
        {
            foreach ( $request['tag_name'] as $tag_name )
            {
                $tag = Tag::create([
                    'name'=> $tag_name
                ]);
                $tag_ids[count($tag_ids)] = $tag->id;
            }
        }

        if ( $request->has('tag_id') )
        {
            foreach ( $request['tag_id'] as $tag_id )
            {

                $tag_ids[count($tag_ids)] = intval($tag_id) ;
            }
        }


        $newItem = Item::create($item);

        foreach ($author_ids as $author_id)
        {
            Item_Author::create([
                'item_id'=> $newItem->id,
                'author_id'=>$author_id
            ]);
        }

        foreach ($tag_ids as $tag_id)
        {
            Tag_Item::create([
                'item_id'=> $newItem->id,
                'tag_id'=>$tag_id
            ]);
        }


        return redirect()->route('item.index');
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
        $maintainers = Maintainer::all();
        $item_types = Item_Type::all();
        $subjects = Subject::all();
        $item_states = Item_State::all();

        $item = Item::find($id);
        $tags = $item->getTags();
        $authors = $item->getAuthors();

        return view('admin_panel.items.edit',compact('item','authors','tags','maintainers','item_types','subjects','item_states'));
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
        return $request->all();
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


    public function show_add_item_request()
    {
        $items = Item::where('is_active',0)->get();
        return view('admin_panel.items.add_item_request',compact('items'));
    }

    public function rejection_add_item_request($id)
    {
        $item = Item::find($id);

        $item->delete();

        return redirect()->route('item.add_item_request');

    }
    public function accept_add_item_request($id)
    {
        $item = Item::find($id);
        $item -> is_active = 1;
        $item -> save();

        return redirect()->route('item.add_item_request');
    }

}
