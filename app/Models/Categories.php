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
}
