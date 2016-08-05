<?php

namespace App\Http\Controllers;


use App\Models\User_Type;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Articles;
use App\Models\Article_Status;
use App\Models\Categories;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\Hash;

class AdministratorController extends Controller
{
    public function __construct()
    {
        $this->middleware('administrator');
    }
    
    /*
     * Creating new article
     */
    public function create_article()
    {
        $categories = new Categories;
        $article_status = new Article_Status();
        
        $data = [
            'categories' => $categories->all(),
            'article_status' => $article_status->all(),
        ];
        
        return view('dashboard.administrator.create_article', compact('data'));
    }

    /*
     * Saves information about the article
     */
    public function store_article(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:255',
            'preview' => 'required|max:255',
            'articleContent' => 'required',
            'category_.*' => 'integer',
            'imgUrl' => 'url',
            'status' => 'integer',
        ]);

        $article = new Articles();

        $result = $article->create_article($request, $request->status);

        if($result) {
            Session::flash('flash_message_text', 'Статья была успешно создана');
            Session::flash('flash_message_class', 'success');
            return redirect('/dashboard/administrator/articles/' . $result . '/edit');
        }
        else {
            Session::flash('flash_message_text', 'Ошибка создания статьи');
            Session::flash('flash_message_class', 'danger');
            return back();
        }
    }

    /*
     * Editing existing page
     */
    public function edit_article(Articles $article)
    {
        $categories = new Categories();
        $article_status = new Article_Status();

        $data = [
            'categories' => $categories->all(),
            'article' => $article,
            'article_status' => $article_status->all(),
        ];

        return view('dashboard.administrator.edit_article', compact('data'));
    }

    /*
     * Updating articles data
     */
    public function update_article(Articles $article, Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:255',
            'preview' => 'required|max:255',
            'articleContent' => 'required',
            'category_.*' => 'integer',
            'imgUrl' => 'url',
            'status' => 'integer',
        ]);

        $result = $article->update_article($request, $request->status);

        if($result) {
            Session::flash('flash_message_text', 'Статья была успешно обновлена');
            Session::flash('flash_message_class', 'success');
        }
        else {
            Session::flash('flash_message_text', 'Ошибка обновления статьи');
            Session::flash('flash_message_class', 'danger');
        }
        return back();
    }

    /*
     * Article preview page
     */
    public function article_preview(Articles $article)
    {
        $data = [
            'article' => $article,
        ];

        return view('dashboard.administrator.article_preview', compact('data'));
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

        return view('dashboard.administrator.own_articles', compact('data'));
    }

    /*
     * List of all articles page
     */
    public function all_articles_list()
    {
        $articles = new Articles;
        $categories = new Categories;

        $data = [
            'articles' => $articles->paginate(10),
            'categories' => $categories->all(),
        ];

        return view('dashboard.administrator.all_articles', compact('data'));
    }

    /*
     * List of author certain category articles page
     */
    public function category_list(Categories $category)
    {
        $categories = new Categories;

        $data = [
            'articles' => $category->articles()->paginate(10),
            'categories' => $categories->all(),
            'category' => $category->name,
        ];

        return view('dashboard.administrator.category_articles', compact('data'));
    }

    /*
     * Categories list
     */
    public function categories()
    {
        $categories = new Categories();

        $data = [
            'categories' => $categories->get_categories()
        ];
        
        return view('dashboard.administrator.categories', compact('data'));
    }

    /*
     * Creates new category
     */
    public function create_category(Request $request)
    {
        $this->validate($request, [
            'catname' => 'required|max:255',
            'parent_id' => 'required|integer',
        ]);

        $category = new Categories();
        $category->name = $request->catname;
        $category->parent_id = $request->parent_id;

        if($category->save()) {
            Session::flash('flash_message_text', 'Категория успешно создана');
            Session::flash('flash_message_class', 'success');
        }
        else {
            Session::flash('flash_message_text', 'Ошибка создания категории');
            Session::flash('flash_message_class', 'danger');
        }
        return back();
    }
    
    /*
     * Deletes category
     */
    public function delete_category(Categories $category)
    {
        return $category->delete_category();
    }

    /*
     * List of articles that needs moderation
     */
    public function moderation_list()
    {
        $articles = new Articles;

        $data = [
            'articles' => $articles->need_moderation_list(true),
        ];

        return view('dashboard.administrator.moderation_list', compact('data'));
    }

    /*
     * Article moderation page
     */
    public function moderation(Articles $article)
    {
        $data = [
            'article' => $article,
        ];

        return view('dashboard.administrator.moderation', compact('data'));
    }

    /*
     * Publish article by it's id
     */
    public function publish(Articles $article)
    {
        $article->status_id = 2;

        if($article->update()) {
            Session::flash('flash_message_text', 'Статья была успешно опубликована');
            Session::flash('flash_message_class', 'success');
            return redirect('/dashboard/administrator/moderation_list');
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
        $this->validate($request, [
            'reason' => 'required|max:255'
        ]);

        return $article->reject_article($request);
    }

    /*
     * Users list page
     */
    public function users_list()
    {
        $users = new User;

        $data = [
            'users' => $users->paginate(10),
        ];
        return view('dashboard.administrator.users_list', compact('data'));
    }

    /*
     * Creation user page
     */
    public function create_user()
    {
        $user_type = new User_Type();
        $data = [
            'user_type' => $user_type->all(),
        ];
        
        return view('dashboard.administrator.create_user', compact('data'));
    }

    /*
     * Stores new user
     */
    public function store_user(Request $request)
    {
        $this->validate($request, [
            'username' => 'unique:users,name|required|max:255',
            'email' => 'unique:users,email|required|max:255',
            'type' => 'integer|exists:user_type,id',
            'password' => 'confirmed|required|max:255|min:6',
        ]);
        
        $user = new User;
        return $user->create_user($request);
    }

    /*
     * User editing page
     */
    public function edit_user(User $user)
    {
        $user_type = new User_Type;
        $categories = new Categories();
        
        $data = [
            'user' => $user,
            'user_type' => $user_type->all(),
            'categories' => $categories->all(),
        ];

        return view('dashboard.administrator.edit_user', compact('data'));
    }

    /*
     * Update user
     */
    public function update_user(Request $request)
    {
        $this->validate($request, [
            'username' => 'required|max:255|unique:users,name,'.$request->user_id,
            'email' => 'required|max:255|unique:users,email,'.$request->user_id,
            'type' => 'integer|exists:user_type,id',
            'user_id' => 'integer|exists:users,id',
            'moderator_category_.*' => 'integer|exists:categories,id',
        ]);
        $user = new User;
        return $user->find($request->user_id)->update_user($request);
    }

    /*
     * Changes user password
     */
    public function change_password(Request $request)
    {
        $this->validate($request, ['password' => 'confirmed|required|max:255|min:6']);
        $user = new User;
        $user = $user->find($request->user_id);
        $user->password = Hash::make($request->password);
        if($user->update()){
            Session::flash('flash_message_text', 'Пароль успешно изменен');
            Session::flash('flash_message_class', 'success');
        }
        else {
            Session::flash('flash_message_text', 'Ошибка изменения пароля');
            Session::flash('flash_message_class', 'danger');
        }
        return back();
    }
    
    /*
     * Deleting user
     */
    public function delete_user(User $user)
    {
        return $user->delete_user();
    }
}
