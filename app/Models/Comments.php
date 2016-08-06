<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    /*
     * Relation with user
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
