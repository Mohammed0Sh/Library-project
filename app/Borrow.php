<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Borrow extends Model
{


    protected $table = 'borrows';

    protected $fillable = ['item_id', 'user_id', 'borrow_state_id', 'return_date'];

    public function getItem()
    {
        return $this->belongsTo('App\Item','item_id');
    }

    public function getUser()
    {
        return $this->belongsTo('App\User','user_id');
    }

    public function getBorrow_State()
    {
        return $this->belongsTo('App\Borrow_State','borrow_state_id');
    }

    public function getExtend_Borrowing()
    {
        return $this->hasMany('App\Extend_Borrowing','borrow_id');
    }



}
