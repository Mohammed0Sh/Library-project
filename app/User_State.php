<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_State extends Model
{
    protected $table = 'user_states';
    protected $fillable = ['name'];

    public function getUsers()
    {
        return $this->hasMany('App\User','user_state_id');
    }



}
