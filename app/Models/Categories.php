<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Categories extends Model
{
    protected $fillable = ['name', 'parent_id', 'has_parent'];

    /*
     * Receives category id
     * Deletes category and it's child categories
     */
    public function delete_with_children()
    {
        if(!empty($this->get_children_list())) {
            /*
             * Getting all children and checking them
             */
            foreach($this->get_children_list() as $cat){
                $child = new Categories;
                $child = $child->find($cat->id);

                $result = $child->delete_with_children();

                /*
                 * Checking problems with deleting child categories
                 */
                if(!$result){
                    return $result;
                }
            }
        }

        /*
         * Deleting relations with articles
         */
        if(!$this->articles->isEmpty()) {
            if(!$result = $this->articles()->detach()) return false;
        }
        /*
         * If no child categories - deleting this category
         */
        return $this->delete();
    }

    /*
     * Returns array of children categories
     */
    protected function get_children_list()
    {
        return DB::select('
            SELECT * FROM `categories` WHERE `parent_id` = '.$this->id.'
        ');
    }

    /*
     * Relation with Article_status table
     */
    public function articles()
    {
        return $this->belongsToMany('App\Models\Articles', 'category_article', 'category_id', 'article_id');
    }
}
