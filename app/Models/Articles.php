<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Articles extends Model
{
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

    /*
     * Creates new article
     * Returns true or false
     */
    public function create_article($request)
    {
        $this->user_id = Auth::user()->id;
        $this->title = $request['title'];
        $this->preview = $request['preview'];
        $this->img = $request['imgUrl'];
        $this->content = $request['articleContent'];
        $this->status_id = 1;

        if($this->save()){
            if(!is_null($request['category_'])) {
                if($this->categories()->sync($request['category_'])) {
                    return $this->id;
                }
                else {
                    return false;
                }
            }
            else {
                return $this->id;
            }
        }
        else return false;
    }

    /*
     * Updates existing article
     */
    public function update_article($request)
    {
        $this->user_id = Auth::user()->id;
        $this->title = $request['title'];
        $this->preview = $request['preview'];
        $this->img = $request['imgUrl'];
        $this->content = $request['articleContent'];
        $this->status_id = 1;

        if($this->update()){
            if(!is_null($request['category_'])) {
                if($this->categories()->sync($request['category_'])) {
                    return true;
                }
                else {
                    return false;
                }
            }
            else {
                $this->categories()->detach();
                return true;
            }
        }
        else return false;
    }

    /*
     * Deletes existing article and all relations
     */
    public function delete_article()
    {
        if($this->categories->isEmpty()){
            return $this->delete();
        }
        else {
            if($this->categories()->detach()){
                return $this->delete();
            }
            else return false;
        }
    }
}
