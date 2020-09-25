<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Borrow_State extends Model
{
    protected $table = 'borrow_states';
    protected $fillable = ['name'];

    public function getBorrow()
    {
        return $this->hasMany('App\Borrow','borrow_state_id');
    }
}
