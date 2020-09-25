<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class File extends Model
{
    protected $table = 'files';
    protected $fillable = ['item_id', 'name', 'type'];


    public function getItem()
    {
        return $this->belongsTo('App\Item','item_id');
    }

}
