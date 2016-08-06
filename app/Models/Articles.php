<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\Article_Reject_Messages;

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
     * Relation with comments
     */
    public function comments(){
        return $this->hasMany('App\Models\Comments', 'article_id');
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
    public function create_article($request, $status_id = 1)
    {
        $this->user_id = Auth::user()->id;
        $this->title = $request['title'];
        $this->preview = $request['preview'];
        $this->img = $request['imgUrl'];
        $this->content = $request['articleContent'];
        $this->status_id = $status_id;

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
    public function update_article($request, $status_id = 1)
    {
        $this->title = $request['title'];
        $this->preview = $request['preview'];
        $this->img = $request['imgUrl'];
        $this->content = $request['articleContent'];
        $this->status_id = $status_id;

        if($this->update()){
            if(!is_null($request['category_'])) {
                if($this->categories()->sync($request['category_'])) {
                    $msg = new Article_Reject_Messages;
                    if(!is_null($msg->all()->where('article_id', $this->id)->first())) $msg->all()->where('article_id', $this->id)->first()->delete();
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
            /*
             * Deleting comments
             */
            $this->comments()->delete();

            if($this->categories()->detach()){
                $msg = new Article_Reject_Messages;
                if(!is_null($msg->all()->where('article_id', $this->id)->first())) $msg->all()->where('article_id', $this->id)->first()->delete();
                return $this->delete();
            }
            else return false;
        }
    }
    
    /*
     * Relation with reject messages
     */
    public function reject_message()
    {
        return $this->hasOne('App\Models\Article_Reject_Messages', 'article_id');
    }

    /*
     * Return list of all articles that need moderation for current moderator
     */
    public function need_moderation_list($administrator = false)
    {
        $articles = [];

        if($administrator){
            $articles = $this->where('status_id', 3)->get();
            if($articles->isEmpty()) $articles = [];
        }
        else {
            foreach (Auth::user()->moderated_categories as $category){
                foreach ($category->articles->where('status_id', 3) as $article){
                    $save = true;

                    foreach ($articles as $existing){
                        if(($existing['id'] == $article->id) || ($existing['user_id'] == Auth::user()->id)) $save = false;
                    }

                    if($save){
                        $new_article = [
                            'id' => $article->id,
                            'title' => $article->title,
                            'author' => (is_null($article->user)) ? "Velosophers" : $article->user->name,
                        ];
                        array_push($articles, $new_article);
                    }

                }
            }
        }

        return $articles;
    }

    /*
     * Reject article publishing
     * Return redirect
     */
    public function reject_article($request)
    {
        $this->status_id = 4;

        if($this->update()) {
            $message = new Article_Reject_Messages;
            $message->article_id = $this->id;
            $message->text = $request['reason'];
            if($message->save()){
                Session::flash('flash_message_text', 'Статья была успешно отклонена');
                Session::flash('flash_message_class', 'success');
                if(Auth::user()->user_type == 4) return redirect('/dashboard/administrator/moderation_list');
                return redirect('/dashboard/moderator/moderation_list');
            }
            else {
                Session::flash('flash_message_text', 'Ошибка создания сообщения');
                Session::flash('flash_message_class', 'danger');
                if(Auth::user()->user_type == 4) return redirect('/dashboard/administrator/moderation_list');
                return redirect('/dashboard/moderator/moderation_list');
            }

        }
        else {
            Session::flash('flash_message_text', 'Ошибка отклонения статьи');
            Session::flash('flash_message_class', 'danger');
            return back();
        }
    }
}
