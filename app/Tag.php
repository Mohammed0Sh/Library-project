<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $table = 'tags';

    protected $fillable=['name'];

    public function getTag_Items()
    {
        return $this->hasMany('App\Tag_Item','tag_id');
    }
}
