<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Illuminate\Support\Facades\Session;
use spec\Prophecy\Prediction\CallbackPredictionSpec;

class Categories extends Model
{
    protected $fillable = ['name', 'parent_id', 'has_parent'];
    
    /*
     * Relation with Article_status table
     */
    public function articles()
    {
        return $this->belongsToMany('App\Models\Articles', 'category_article', 'category_id', 'article_id');
    }

    /*
     * Relation with moderators
     */
    public function moderators()
    {
        return $this->belongsToMany('App\User', 'moderator_category', 'category_id', 'moderator_id');
    }

    /*
     * Return true if category has children
     * Return false otherwise
     */
    public function has_children()
    {
        foreach (Categories::all() as $child){
            if($child->parent_id == $this->id) return true;
        }
        return false;
    }

    /*
     * Return array of categories with their  nesting
     */
    public function get_categories()
    {
        $GLOBALS['categories'] = [];
        $GLOBALS['nesting'] = 0;

        /*
         * Receives category id
         * Save all children into $GLOBALS['categories']
         */
        function save_children($id)
        {
            $GLOBALS['nesting']++;

            $children = Categories::all()->where('parent_id', $id);
            foreach ($children as $current){
                $data = [
                    'id' => $current->id,
                    'name' => $current->name,
                    'nesting'=> $GLOBALS['nesting'],
                ];
                array_push($GLOBALS['categories'], $data);
                if($current->has_children()){
                    save_children($current->id);
                }
            }

            $GLOBALS['nesting']--;
        }

        foreach($this->all() as $current){
            if(!$current->parent_id){
                $data = [
                    'id' => $current->id,
                    'name' => $current->name,
                    'nesting'=> $GLOBALS['nesting'] = 0,
                ];
                array_push($GLOBALS['categories'], $data);

                if($current->has_children()){
                    save_children($current->id);
                }
            }
        }

        unset($GLOBALS['nesting']);
        return $GLOBALS['categories'];
    }

    /*
     * Deletes category and all it's relations
     */
    public function delete_category()
    {
        if($this->articles()) $this->articles()->detach();
        if($this->moderators()) $this->moderators()->detach();

        if($this->has_children()){
            foreach (Categories::all()->where('parent_id', $this->id) as $child){
                $child->delete_category();
            }
        }

        if($this->delete()) {
            Session::flash('flash_message_text', 'Категория успешно удалена');
            Session::flash('flash_message_class', 'success');
        }
        else {
            Session::flash('flash_message_text', 'Ошибка удаления категории');
            Session::flash('flash_message_class', 'danger');
        }
        return back();
    }
}
