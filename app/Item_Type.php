<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Item_Type extends Model
{
    protected $table = 'item_types';
    protected $fillable = ['name'];


    public function getItems()
    {
        return $this->hasMany('App\Item','item_type_id');
    }

}
