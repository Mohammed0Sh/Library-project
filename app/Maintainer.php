<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Maintainer extends Model
{
    protected $table = 'maintainers';

    protected $fillable = ['first_name','last_name','mobile','email'];


    public function getItems()
    {
        return $this->hasMany('App\Item','maintainer_id');
    }

}
