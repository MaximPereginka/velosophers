<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Articles;

class AdministratorController extends Controller
{
    public function __construct()
    {
        $this->middleware('administrator');
    }

    /*
     * Dashboard main page
     */
    public function index()
    {
        return view('dashboard.administrator.home');
    }
    
    /*
     * Creating new article
     */
    public function create_article()
    {
        return "Страница создания статтей";
    }

    /*
     * Saves information about the article
     */
    public function save_new_article(Request $request)
    {
        return "Статья успешно создано";
    }

    /*
     * Editing existing page
     */
    public function edit_article(Articles $article)
    {
        return "Страница редактирования статьи";
    }

    /*
     * Updating articles data
     */
    public function update_article(Articles $article, Request $request)
    {

    }

    /*
     * Article preview page
     */
    public function article_preview(Articles $article)
    {
        return "Страница предварительного просмотра статтей";
    }

    /*
     * List of author articles page
     */
    public function own_articles_list()
    {
        return "Список статтей текущего пользователя";
    }

    /*
     * Deletes existing article
     */
    public function delete_article(Article $article)
    {
        return "Удаление страницы";
    }
    
    /*
     * List of articles that needs moderation
     */
    public function moderation_list()
    {
        return "Страница модерации статтей";
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
    public function reject(Aticles $article, Request $request)
    {
        return "Отклоняет статью с указанной приичиной отклонения";
    }

    /*
     * Users list page
     */
    public function users()
    {
        return "Список пользователей";
    }

    /*
     * User editing page
     */
    public function new_user()
    {
        return "Создаёт нового пользователя";
    }

    /*
     * Creates user
     */
    public function create_user(Request $request)
    {
        return "Создали пользователя";
    }

    /*
     * User editing page
     */
    public function edit_user(User $user)
    {
        return "Страница редактирования пользователя";
    }

    /*
     * Update user
     */
    public function update_user(Request $request)
    {
        return "Обновили информацию о пользователе";
    }
}
