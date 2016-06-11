<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Categories extends Model
{
    protected $fillable = ['name', 'parent_id', 'has_parent'];

    /*
     * Returns categories with their parents
     */
    public function get_with_parent()
    {
        return DB::select('
            SELECT `c1`.*, `c2`.`name` as `parent` 
            FROM `categories` AS `c1`
            LEFT JOIN `categories` as `c2` ON `c1`.`parent_id` = `c2`.`id`
        ');
    }

    /*
     * Receives category id
     * Deletes category and it's child categories
     */
    public function delete_with_children($id)
    {
        $id = (int)$id;

        if(!empty($this->get_children_list($id))) {
            /*
             * Getting all children and checking them
             */
            foreach($this->get_children_list($id) as $cat){
                $result = $this->delete_with_children($cat->id);

                /*
                 * Checking problems with deleting child categories
                 */
                if(!$result){
                    return $result;
                }
            }
        }

        /*
         * If no child categories - deleting this category
         */
        $result = DB::delete('DELETE FROM `categories` WHERE `id` = '.$id);

        return $result;
    }

    /*
     * Receives category id
     * Returns list of children categories
     */
    protected function get_children_list($id)
    {
        $id = (int)$id;

        return DB::select('
            SELECT * FROM `categories` WHERE `parent_id` = '.$id.'
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
