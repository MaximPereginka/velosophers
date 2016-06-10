<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /*
     * Relation with articles
     */
    public function articles()
    {
        return $this->hasMany('App\Models\Articles');
    }
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'user_type', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'remember_token',
    ];
    
    /*
     * Relation with user_type
     */
    public function type()
    {
        return $this->belongsTo('App\Models\User_Type', 'user_type', 'id');
    }
}
