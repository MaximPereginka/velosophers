<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Articles;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ModeratorController extends Controller
{
    /*
     * Displays list articles from current moderator categories
     */
    public function moderation_list()
    {
        $articles = new Articles;

        $data = [
            'articles' => $articles->need_moderation_list(),
        ];
        
        return view('dashboard.moderator.moderation_list', compact('data'));
    }

    /*
     * Article moderation page
     */
    public function moderation(Articles $article)
    {
        if(!$this->check_rights($article->status_id)) return redirect('/dashboard/moderator/moderation_list');

        $data = [
            'article' => $article,
        ];
        
        return view('dashboard.moderator.moderation', compact('data'));
    }
    
    /*
     * Publish article by it's id
     */
    public function publish(Articles $article)
    {
        if(!$this->check_rights($article->status_id)) return redirect('/dashboard/moderator/moderation_list');

        $article->status_id = 2;

        if($article->update()) {
            Session::flash('flash_message_text', 'Статья была успешно опубликована');
            Session::flash('flash_message_class', 'success');
            return redirect('/dashboard/moderator/moderation_list');
        }
        else {
            Session::flash('flash_message_text', 'Ошибка публикации статьи');
            Session::flash('flash_message_class', 'danger');
            return back();
        }
    }

    /*
     * Rejecting article with page
     */
    public function reject(Articles $article, Request $request)
    {
        if(!$this->check_rights($article->status_id)) return redirect('/dashboard/moderator/moderation_list');

        $this->validate($request, [
            'reason' => 'required|max:255'
        ]);
        
        return $article->reject_article($request);
    }

    /*
     * Check right to moderate article
     */
    protected function check_rights($status)
    {
        if($status != 3) {
            Session::flash('flash_message_text', 'Вы не можете модерировать данную статью');
            Session::flash('flash_message_class', 'danger');
            return false;
        }
        return true;
    }
}
