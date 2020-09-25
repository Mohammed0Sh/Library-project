<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    protected $table = 'favorites';

    protected $fillable = ['user_id', 'item_id'];


    public function getItem()
    {
        return $this->belongsTo('App\Item','item_id');
    }

    public function getUser()
    {
        return $this->belongsTo('App\User','user_id');
    }

}
