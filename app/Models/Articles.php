<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Articles extends Model
{
    /*
     * List of mass-assignable fields
     */
    protected $fillable = ['title', 'content', 'user_id'];

    /*
     * Relation with user
     */
    public function user(){
        return $this->belongsTo('App\User');
    }
}
