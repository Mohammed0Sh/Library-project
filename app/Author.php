<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    protected $table = 'authors';
    protected $fillable = ['first_name','last_name','mobile'];


    public function getItem_Authors()
    {
        return $this->hasMany('App\Item_Author','author_id');
    }
}
