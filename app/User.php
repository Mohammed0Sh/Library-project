<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name','last_name', 'email', 'password','role_id','user_state_id','api_token',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];



    public function getBorrows()
    {
        return $this->hasMany('App\Borrow','user_id');
    }


    public function getRole()
    {
        return $this->belongsTo('App\Role','role_id');
    }


    public function getFavorites()
    {
        return $this->hasMany('App\Favorite','user_id');
    }


    public function getUser_State()
    {
        return $this->belongsTo('App\User_State','user_state_id');
    }

    public function getInfraction_Borrows()
    {

    }


    public function isFavorite($item_id)
    {
        $favorites = $this->getFavorites;
        $curr_favorite = null;
        foreach ($favorites as $favorite)
        {
            if ($favorite->item_id == $item_id)
            {
                $curr_favorite = $favorite;
                return $curr_favorite;
            }
        }
        return $curr_favorite;
    }

    public function isReservation($item_id) // check if this user have reservation with item that his id is $item_id
    {
        $count = count($this->getBorrows->where('item_id',$item_id)->where('borrow_state_id',1));
        if ($count == 0)
        {
            return false;
        }
        else
        {
            return true;
        }

    }

    public function getReservation($item_id) // return the reservation which user had with item that his id is $item_id
    {
        return $this->getBorrows->where('item_id',$item_id)->where('borrow_state_id',1)->last();
    }

    public function getCancelled_Reservation() // return the reservation which user had with item that his id is $item_id
    {
        return $this->getBorrows->where('borrow_state_id',8);
    }

    public function getmyBorrows()
    {

        $borrows = Borrow::select()
            ->where('user_id', $this->id)
            ->where('borrow_state_id',3)->get();

        return $borrows;
    }

    public function getmyReservation()
    {

        $reservations = Borrow::select()
            ->where('user_id', $this->id)
            ->where('borrow_state_id', 1)->get();

        return $reservations;
    }

    public function getExtend_Borrowing()
    {
        return $this->hasMany('App\Extend_Borrowing','user_id');
    }

    public function hasExtend_Borrowing_on_borrow($id)
    {
        $Extend_Borrows = $this->getExtend_Borrowing;

        foreach ($Extend_Borrows as $Extend_Borrow)
        {
            if ($Extend_Borrow ->borrow_id == $id)
            {
                return true;
            }
        }
        return false;
    }




}
