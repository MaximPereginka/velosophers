<?php

namespace App\Http\Controllers;

use App\Http\Middleware\RedirectIfAuthenticated;
use App\Models\Article_Status;
use App\Models\Categories;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Articles;
use App\User;
use Illuminate\Support\Facades\Session;

class BlogController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /*
     * All articles list page
     */
    public function administrator_index()
    {
        $articles = new Articles;
        $articles = $articles->all();

        return view('blog.administrator_index', compact('articles'));
    }
    
    /*
     * List of current user articles page
     */
    public function own()
    {
        $user = new User;
        $articles = $user->find(\Auth::user()->id)->articles;

        return view('blog.own', compact('articles'));
    }
    
    /*
     * List of articles of specific category
     */
    public function category(Categories $category)
    {
        $data = [
            'category' => $category,
            'articles' => $category->articles->all(),
        ];
        
        return view('blog.category_articles', $data);
    }
    
    /*
     * Creating article page
     */
    public function create()
    {
        $categories = new Categories();
        $statuses = new Article_Status();

        $data = [
            'categories' => $categories->all(),
            'statuses' => $statuses->all()
        ];

        return view('blog.create', compact('data'));
    }

    /*
     * Saving new article
     */
    public function store(Request $request)
    {
        /*
         * Validation
         */
        $this->validate($request, [
            'title' => 'required|max:255',
            'preview' => 'required|max:255',
            'articleContent' => 'required',
            'status_id' => 'integer|required',
            'category.*' => 'integer'
        ]);

        $article = new Articles;

        $article->user_id = $request->user()->id;
        $article->title = $request->title;
        $article->preview = $request->preview;
        $article->img = $request->img_url;
        $article->content = $request->articleContent;
        $article->status_id = $request->status_id;

        if($article->save()){
            if($request->category) {
                $article->categories()->sync($request->category);
            }
            Session::flash('flash_message', 'Статья успешно создана');
            Session::flash('flash_message_level', 'success');
            return \Redirect::to("/administrator/blog/edit/".$article->id);
        }
        else{
            return \Redirect::back()->withErrors($article->errors());
        }
    }

    /*
     * Article preview page
     */
    public function administrator_view(Articles $article)
    {
        return view('blog.administrator_view', compact('article'));
    }

    /*
     * Editing existing article page
     */
    public function edit(Articles $article)
    {
        $categories = new Categories();
        $statuses = new Article_Status();

        $data = [
            'categories' => $categories->all(),
            'statuses' => $statuses->all()
        ];

        if(is_null($article->user)){
            $users = new User;
            $data['users'] = $users->whereIn('user_type', [2,4])->get();
        }

        return view('blog.edit', compact('article', 'data'));
    }

    /*
     * Updating existing article
     */
    public function update(Request $request, Articles $article)
    {
        /*
         * Validation
         */
        $this->validate($request, [
            'title' => 'required|max:255',
            'preview' => 'required|max:255',
            'articleContent' => 'required',
            'status_id' => 'integer|required',
            'category.*' => 'integer',
            'user' => 'integer|in:2,4',
        ]);

        $article->title = $request->title;
        $article->preview = $request->preview;
        $article->img = $request->img_url;
        $article->content = $request->articleContent;
        $article->status_id = $request->status_id;
        if(isset($request->user_id) and (\Auth::user()->user_type == 4)) $article->user_id = $request->user_id;
        else {
            Session::flash('flash_message', 'Вы не можете назначать авторов');
            Session::flash('flash_message_level', 'danger');
            back();
        }

        if($article->update()){
            if($request->category) {
                $article->categories()->sync($request->category);
            }
            else {
                $article->categories()->detach();
            }
            Session::flash('flash_message', 'Статья успешно сохранена');
            Session::flash('flash_message_level', 'success');
            return back();
        }
        else{
            return Redirect::back()->withErrors($article->errors());
        }
    }

    /*
     * Deleting existing article
     */
    public function delete(Articles $article)
    {
        if($article->delete()){
            $article->categories()->detach();
            Session::flash('flash_message', 'Статья успешно удалена');
            Session::flash('flash_message_level', 'success');
        }
        else {
            Session::flash('flash_message', 'Ошибка удаления статьи');
            Session::flash('flash_message_level', 'danger');
        }

        return \Redirect::to('/administrator/blog/own');
    }

    /*
     * Categories list page
     */
    public function categories()
    {
        $categories = new Categories;
        $GLOBALS['categories'] = $categories->orderBy('id','asc')->orderBy('has_parent','asc')->get();
        $GLOBALS['tree'] = [];
        $GLOBALS['nesting'] = 0;
        $GLOBALS['length'] = count($GLOBALS['categories']);

        /*
         * Receives id of category
         * Returns true if category has children
         * Returns false otherwise
         */
        function has_children($id)
        {
            foreach ($GLOBALS['categories'] as $category){
                if(!is_null($category)){
                    if($category->parent_id == $id) return true;
                }
            }
            return false;
        }

        /*
         * Receives id of category
         * Saving child categories (category object|nesting)
         */
        function get_children($id){
            $GLOBALS['nesting']++;
            $children = [];

            for($i = 0; $i < $GLOBALS['length']; $i++){
                if(is_null($GLOBALS['categories'][$i])){
                    continue;
                }
                else {
                    if($GLOBALS['categories'][$i]->parent_id == $id) {
                        $current = [
                            'category' => $current['category'] = $GLOBALS['categories'][$i],
                            'nesting' => $GLOBALS['nesting'],
                        ];
                        array_push($GLOBALS['tree'], $current);

                        if(has_children($GLOBALS['categories'][$i]->id)){
                            get_children($GLOBALS['categories'][$i]->id);

                        }
                        $GLOBALS['categories'][$i] = null;
                    }
                }
            }

            $GLOBALS['nesting']--;
            return $children;
        }

        for($i = 0; $i < $GLOBALS['length']; $i++){
            if(is_null($GLOBALS['categories'][$i])){
                continue;
            }
            else {
                $current = [
                    'category' => $GLOBALS['categories'][$i],
                    'nesting' => $GLOBALS['nesting'],
                ];

                array_push($GLOBALS['tree'], $current);

                if(has_children($GLOBALS['categories'][$i]->id)){
                    get_children($GLOBALS['categories'][$i]->id);
                }

                $GLOBALS['categories'][$i] = null;
            }
        }

        $data = [
            'tree' => $GLOBALS['tree'],
            'categories' => $categories->all(),
        ];

        unset($GLOBALS['categories']);
        unset($GLOBALS['length']);
        unset($GLOBALS['tree']);
        unset($GLOBALS['nesting']);

        return view('blog.categories', compact('data'));
    }

    /*
     * Creates new category
     */
    public function create_category(Request $request)
    {
        $has_parent = false;

        /*
         * Validation
         */
        $this->validate($request, [
            'title' => 'required|max:255|unique:categories,name',
            'parent_id' => 'required|integer',
        ]);

        if(!$request->parent_id == 0) $has_parent = true;
        if(Categories::create([
            'name' => $request->title,
            'parent_id' => $request->parent_id,
            'has_parent' => $has_parent,
        ])) {
            Session::flash('flash_message', 'Категория успешно создана');
            Session::flash('flash_message_level', 'success');
        }

        return back();
    }

    /*
     * Deleting existing category and it's children
     */
    public function delete_category(Categories $category)
    {
        if($category->delete_with_children($category->id)){
            Session::flash('flash_message', 'Категория успешно удалена');
            Session::flash('flash_message_level', 'success');
        }
        else {
            Session::flash('flash_message', 'Ошибка удаления категории');
            Session::flash('flash_message_level', 'danger');
        }

        return \Redirect::to('/administrator/blog/categories');
    }
}
