<?php

namespace App\Http\Controllers\Api;

use App\Author;
use App\Http\Controllers\Controller;
use App\Item;
use App\Item_State;
use App\Item_Type;
use App\Maintainer;
use App\Subject;
use App\User;
use App\Tag;
use App\File;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Faker\Factory as Faker;
use Illuminate\Database\Eloquent\Collection;

class HomeController extends Controller
{
    use AuthenticatesUsers;


    public function getFilters()
    {
        $maintainers = Maintainer::all();
        $item_types = Item_Type::all();
        $subjects = Subject::all();
        $item_states = Item_State::all();
       return response()->json(['maintainer'=>$maintainers,'item_type'=>$item_types,'subject'=>$subjects,'item_state'=>$item_states]);

    }


    public function show_item_detile()
    {
        $item = Item::find((int)request('id'));

        $tags = $item->getTags();

        $authors = $item->getAuthors();
        $files=$item->getFiles;

        return response()->json(['item'=>$item,'tags'=>$tags,'authors'=>$authors,'files'=>$files]);
    }

    public  function login(){
        if (auth()->attempt(['email' => \request('email'), 'password' => \request('password')])) {
            return \response()->json(['status' => true, 'user' => auth()->user()]);
        } else {
            return \response()->json(['status' => false, 'message' => 'error']);
        }
    }



    public function Search_Result()
    {

        $items = [];
        $items1 = [];
        $items2 = [];
        $items3 = [];
        $text_search = request('search');
       
        $filters =[];

        foreach (request()->toArray()  as $key => $value )
        {
            if ($value != 0 && $key !='search')
            {
                $filters[$key.'_id'] = (int)$value;
            }

        }

    
    
        # where (name == %$text_search% || desc == %$text_search%) && m_id = v
        if ($text_search !=null )
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
                            $query->where($key,'=',(int)$value);
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
        foreach($items as $item)
        {
            $item['isFavorate']=false;
            $item['isReservation']=false;
           }

if(\request()->has('user_token'))
{

    $user = User::where('api_token',\request('user_token'))->first();
     $favorate = $user->getFavorites;
     $reserve = $user->getmyReservation();


   //  return response()->json($favorate);




    foreach($items as $item)
    {
       
        foreach($favorate as $f)
        {
            if($item['id'] == $f->item_id)
                $item['isFavorate']=true;

        }

        foreach($reserve as $r)
        {
            if($item['id']== $r->item_id)
                $item['isReservation']=true;
        }
    }
}



   return response()->json($items);
    }


    public function addUserRequest()
    {
       $faker =  Faker::create();
        $data=[];
        $data['first_name']= request('first_name');
        $data['last_name']=request('last_name');
        $data['email']=request('email');
        $data['password'] = bcrypt(request('password'));
        $data['api_token']=$faker->text($maxNvchars = 60);
        User::create($data + ['user_state_id' => 0 , 'role_id' => 2]);
        return response()->json(['status'=>true]);


    }
    public function getAllTags(){
        $tags=Tag::all();
        return response()->json($tags);
    }

    public function download_file()
    {
        $file = File::find((int)request('id'));
        $file_path = 'item_files/'.$file->type.'/'.$file->name;
        return response()->json('http://192.168.43.144/laravel_project/public/'.$file_path);
    }





}
