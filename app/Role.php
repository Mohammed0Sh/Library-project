<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table='roles';

    protected $fillable = ['name'];

    public function getUsers()
    {
        return $this->hasMany('App\User','role_id');
    }

}
