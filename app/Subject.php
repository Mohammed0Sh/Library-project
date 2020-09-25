<?php

namespace App;

use Illuminate\Database\Eloquent\Model;



class Subject extends Model
{
    protected $table = 'subjects';

    protected $fillable = ['name','specialize_id','academic_year_id'];

    public function getSpecialize()
    {
        return $this->belongsTo('App\Specialize','specialize_id');
    }

    public function getAcademic_Year()
    {
        return $this->belongsTo('App\Academic_Year','academic_year_id');
    }



    public function getItems()
    {
        return $this->hasMany('App\Item','subject_id');
    }

}
