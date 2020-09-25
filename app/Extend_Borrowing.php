<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Extend_Borrowing extends Model
{
    protected $table = 'extend_borrowings';

    protected $fillable = ['borrow_id','user_id','day'];


    public function getUser()
    {
        return $this->belongsTo('App\User','user_id');
    }

    public function getBorrow()
    {
        return $this->belongsTo('App\Borrow','borrow_id');
    }

}
