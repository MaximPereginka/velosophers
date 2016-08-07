<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;
use App\Models\Comments;

use App\Http\Requests;
use App\Models\Articles;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use App\Models\Article_Reject_Messages;

class AuthorController extends Controller
{
    /*
     * Creating new article
     */
    public function create_article()
    {
        $categories = new Categories();

        $data = [
            'categories' => $categories->all(),
        ];
        
        return view('dashboard.author.create_article', compact('data'));
    }
    
    /*
     * Saves information about the article
     */
    public function save_new_article(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:255',
            'preview' => 'required|max:255',
            'articleContent' => 'required',
            'category_.*' => 'integer',
            'imgUrl' => 'url',
        ]);

        $article = new Articles();

        $result = $article->create_article($request);

        if($result) {
            Session::flash('flash_message_text', 'Статья была успешно создана');
            Session::flash('flash_message_class', 'success');
            return redirect('/dashboard/author/articles/' . $result . '/edit');
        }
        else {
            Session::flash('flash_message_text', 'Ошибка создания статьи');
            Session::flash('flash_message_class', 'danger');
            return back();
        }

    }

    protected function check_user($id)
    {
        if($id != Auth::user()->id){
            Session::flash('flash_message_text', 'Вы не можете редактировать данную статью');
            Session::flash('flash_message_class', 'danger');
            return false;
        }
        else return true;
    }

    /*
     * Editing existing page
     */
    public function edit_article(Articles $article)
    {
        if(!$this->check_user($article->user_id)) return redirect('/dashboard');

        $categories = new Categories();

        $data = [
            'categories' => $categories->all(),
            'article' => $article,
        ];

        return view('dashboard.author.edit_article', compact('data'));
    }

    /*
     * Updating articles data
     */
    public function update_article(Articles $article, Request $request)
    {
        if(!$this->check_user($article->user_id)) return redirect('/dashboard');

        $this->validate($request, [
            'title' => 'required|max:255',
            'preview' => 'required|max:255',
            'articleContent' => 'required',
            'category_.*' => 'integer',
            'imgUrl' => 'url',
        ]);
        
        $result = $article->update_article($request);

        if($result) {
            Session::flash('flash_message_text', 'Статья была успешно обновлена');
            Session::flash('flash_message_class', 'success');
            return back();
        }
        else {
            Session::flash('flash_message_text', 'Ошибка обновления статьи');
            Session::flash('flash_message_class', 'danger');
            return back();
        }
    }

    /*
     * Article preview page
     */
    public function article_preview(Articles $article)
    {
        if(!$this->check_user($article->user_id)) return redirect('/dashboard');

        $data = [
            'article' => $article,
        ];
        
        return view('dashboard.author.preview_article', compact('data'));
    }

    /*
     * Sends article on moderation
     */
    public function send_on_moderation(Articles $article)
    {
        if(!$this->check_user($article->user_id)) return redirect('/dashboard');

        $article->status_id = 3;

        $msg = new Article_Reject_Messages;
        if(!is_null($msg->all()->where('article_id', $article->id)->first())) $msg->all()->where('article_id', $article->id)->first()->delete();
        
        if($article->update()) {
            Session::flash('flash_message_text', 'Статья была успешно отправлена на модерацию');
            Session::flash('flash_message_class', 'success');
            return back();
        }
        else {
            Session::flash('flash_message_text', 'Ошибка отправки статьи на модерацию');
            Session::flash('flash_message_class', 'danger');
            return back();
        }
    }

    /*
     * Cancel moderation
     */
    public function cancel_moderation(Articles $article)
    {
        if(!$this->check_user($article->user_id)) return redirect('/dashboard');

        $article->status_id = 1;

        if($article->update()) {
            Session::flash('flash_message_text', 'Статья была успешно снята с модерации');
            Session::flash('flash_message_class', 'success');
            return back();
        }
        else {
            Session::flash('flash_message_text', 'Ошибка снятия статьи с модерации');
            Session::flash('flash_message_class', 'danger');
            return back();
        }
    }

    /*
     * Unpublishes article
     */
    public function unpublish(Articles $article)
    {
        if(!$this->check_user($article->user_id)) return redirect('/dashboard');

        $article->status_id = 1;

        if($article->update()) {
            Session::flash('flash_message_text', 'Статья была успешно снята с публикации');
            Session::flash('flash_message_class', 'success');
            return back();
        }
        else {
            Session::flash('flash_message_text', 'Ошибка снятия статьи с публикации');
            Session::flash('flash_message_class', 'danger');
            return back();
        }
    }

    /*
     * Deletes existing article
     */
    public function delete_article(Articles $article)
    {
        if(!$this->check_user($article->user_id)) return redirect('/dashboard');

        if($article->delete_article()) {
            Session::flash('flash_message_text', 'Статья была успешно удалена');
            Session::flash('flash_message_class', 'success');
            if(Auth::user()->user_type == 4) return redirect('/dashboard/administrator/articles/own');
            return redirect('/dashboard/author/articles/own');
        }
        else {
            Session::flash('flash_message_text', 'Ошибка удаления статьи');
            Session::flash('flash_message_class', 'danger');
            return back();
        }
    }

    /*
     * List of author certain category articles page
     */
    public function category_list(Categories $category)
    {
        $categories = new Categories;

        $data = [
            'articles' => $category->articles()->where('user_id', Auth::user()->id)->paginate(10),
            'categories' => $categories->all(),
            'category' => $category->name,
        ];

        return view('dashboard.author.category_list', compact('data'));
    }

    /*
     * List of author articles page
     */
    public function own_articles_list()
    {
        $articles = new Articles;
        $categories = new Categories;

        $data = [
            'articles' => $articles->where('user_id', Auth::user()->id)->paginate(10),
            'categories' => $categories->all(),
        ];

        return view('dashboard.author.own_articles', compact('data'));
    }

    /*
     * Pin or unpin comment from article
     */
    public function pin_comment(Articles $article, Comments $comment)
    {
        if($article->user_id == Auth::user()->id) {
            if($comment->highlighted) {
                Session::flash('flash_message_text', 'Комментарий успешно откреплён');
                $comment->highlighted = false;
            }
            else {
                Session::flash('flash_message_text', 'Комментарий успешно закреплён');
                $comment->highlighted = true;
            }

            if($comment->update()) {
                Session::flash('flash_message_class', 'success');
            }
            else {
                Session::flash('flash_message_text', 'Произошла ошибка. Попробуйте позже');
                Session::flash('flash_message_class', 'danger');
            }
        }
        return back();
    }

    /*
     * Deletes comment from article
     */
    public function delete_comment(Comments $comment)
    {
        if($comment->delete()) {
            Session::flash('flash_message_text', 'Комментарий успешно удалён');
            Session::flash('flash_message_class', 'success');
        }
        else {
            Session::flash('flash_message_text', 'Ошибка удаления комментария');
            Session::flash('flash_message_class', 'danger');
        }
        return back();
    }
}
