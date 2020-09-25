<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Tag_Item extends Model
{
    protected $table = 'tag_items';
    protected $fillable = ['item_id', 'tag_id'];


    public function getItem()
    {
        return $this->belongsTo('App\Item','item_id');
    }

}
