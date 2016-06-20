<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Articles;

class ModeratorController extends Controller
{
    /*
     * Displays list articles from current moderator categories
     */
    public function get_articles_list()
    {
        return "Страница модерации установленных категорий";
    }

    /*
     * Publish article by it's id
     */
    public function publish(Articles $article)
    {
        return "Публикация статьи по id";
    }

    /*
     * Rejecting article with page
     */
    public function reject(Articles $article, Request $request)
    {
        return "Отклоняет статью с указанной приичиной отклонения";
    }
}
