<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Articles extends Model
{
    /*
     * List of mass-assignable fields
     */
    protected $fillable = ['title', 'content', 'user_id', 'category_id'];

    /*
     * Relation with user
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /*
     * Relation with categories
     */
    public function categories()
    {
        return $this->belongsToMany('App\Models\Categories', 'category_article', 'article_id', 'category_id');
    }

    /*
     * Relation with article_status
     */
    public function status()
    {
        return $this->belongsTo('App\Models\Article_Status');
    }
}
