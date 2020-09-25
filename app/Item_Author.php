<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item_Author extends Model
{
    protected $table = 'item_authors';
    protected $fillable = ['item_id', 'author_id'];

    public function getItem()
    {
        return $this->belongsTo('App\Item','item_id');
    }

}
