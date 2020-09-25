<?php

namespace App\Http\Controllers;

use App\Author;
use App\Item;
use App\Tag;
use App\Tag_Item;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class HomeController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $text_search = '';
        $text_search = null;
        $item_type_id = null;
        $maintainer_id = null;
        $subject_id = null;
        $item_state_id = null;
        $items = Item::where('is_active',1) -> paginate(12);
        return view('user.home.index',compact('items','text_search','maintainer_id','subject_id','item_state_id','item_type_id'));
    }


    public function Search_Result(Request $request)
    {

        $items = [];
        $items1 = [];
        $items2 = [];
        $items3 = [];
        $text_search = $request['text_search'];
        $item_type_id = $request['item_type_id'];
        $maintainer_id = $request['maintainer_id'];
        $subject_id = $request['subject_id'];
        $item_state_id = $request['item_state_id'];

        unset($request['text_search']);
        unset($request['_token']);

        $filters =[];

        foreach ($request->toArray()  as $key => $value )
        {
            if ($value != 0)
            {
                $filters[$key] = $value;
            }

        }


        # where (name == %$text_search% || desc == %$text_search%) && m_id = v
        if ($text_search != null )
        {
            $items4 = Item::where(function ($query) use ( $text_search )
            {
                $query->where('name', 'like', "%$text_search%")
                    ->orwhere('desc', 'like', "%$text_search%");
            })
            ->where(function ($query) use ( $filters )
            {
                if (count($filters) != 0)
                {
                    foreach ($filters as $key =>$value)
                    {
                        $query->where($key,'=',$value);
                    }
                }
            }) ->where(function ($query) use ( $filters )
                {
                    $query->where('is_active',1);
                })->get();


            foreach ($items4 as $item)
            {
                $items1[count($items1)] = $item;
            }


            $tags = Tag::where('name', 'like', "%$text_search%")->get();
            if ($tags !=null)
            {

                $item_tags = [];
                foreach ($tags as $tag)
                {
                    $item_tags_for_this_tag = $tag->getTag_Items;
                    if ($item_tags_for_this_tag != null)
                    {
                        foreach ($item_tags_for_this_tag as $item_tag_for_this_tag)
                        {
                            $item_tags[count($item_tags)] = $item_tag_for_this_tag;
                        }
                    }

                }

                if (count($item_tags) != 0)
                {
                    $pass_all = true;
                    foreach ($item_tags as $item_tag)
                    {
                        if (count($filters) != 0)
                        {
                            foreach ($filters as $key => $value)
                            {
                                $curr_item = $item_tag->getItem;
                                if ($curr_item->$key != $value)
                                {
                                    $pass_all = false;
                                    break;
                                }

                            }

                            if ($pass_all)
                            {
                                $items2[count($items2)] = $curr_item;

                            }
                            else
                            {
                                $pass_all = true;
                            }
                        }
                        else
                        {
                            $curr_item = $item_tag->getItem;
                            $items2[count($items2)] = $curr_item;
                        }

                    }
                }

            }



            $authors = Author::where(function ($query) use ( $text_search )
            {
                $query->where('first_name', 'like', "%$text_search%")
                    ->orwhere('last_name', 'like', "%$text_search%");
            })->get();


            if ($authors !=null)
            {
                $item_authors = [];
                foreach ($authors as $author)
                {
                    $item_authors_for_this_author = $author->getItem_Authors;
                    if ($item_authors_for_this_author != null)
                    {
                        foreach ($item_authors_for_this_author as $item_author_for_this_author)
                        {
                            $item_authors[count($item_authors)] = $item_author_for_this_author;
                        }
                    }

                }

                if (count($item_authors) != 0)
                {
                    $pass_all = true;
                    foreach ($item_authors as $item_author)
                    {
                        if (count($filters) != 0)
                        {
                            foreach ( $filters as $key => $value )
                            {
                                $curr_item = $item_author->getItem;
                                if ($curr_item->$key != $value)
                                {
                                    $pass_all = false;
                                    break;
                                }
                            }


                            if ($pass_all)
                            {
                                $items3[count($items3)] = $curr_item;

                            }
                            else
                            {
                                $pass_all = true;
                            }
                        }
                        else
                        {
                            $curr_item = $item_author->getItem;
                            $items3[count($items3)] = $curr_item;
                        }


                    }
                }

            }





        }
        else
        {
            $items4 = Item::where(function ($query) use ( $filters )
            {
                if (count($filters) != 0)
                {
                    foreach ($filters as $key =>$value)
                    {
                        $query->where($key,'=',$value);
                    }
                }

            })->get();


            foreach ($items4 as $item)
            {
                $items1[count($items1)] = $item;
            }

        }



        $items = array_merge( $items, $items1) ;
        $items = array_merge( $items, $items2) ;
        $items = array_merge( $items, $items3) ;


        $items = array_unique($items);



        return view('user.home.search_resalt',compact('items','text_search','maintainer_id','subject_id','item_state_id','item_type_id'));
    }



    public function show_item_detile($id)
    {
        $item = Item::find($id);
        $tags = $item->getTags();
        $authors = $item->getAuthors();
        $files = $item->getFiles;

        return view('user.home.item_detile',compact('item','tags','authors','files'));
    }

    public function show_registe_form()
    {
        return view('user.home.registe');
    }

    public function add_user_request(Request $request)
    {

        $faker =  Faker::create();
        $data = $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);


        $data['password'] = bcrypt($data['password']);
        $data['api_token']=$faker->text($maxNvchars = 60);

        User::create($data + ['user_state_id' => 0 , 'role_id' => 2]);
        return redirect()->route('home');


    }


}
