<?php

namespace App\Http\Controllers;

use App\Models\Article_Status;
use App\Models\Categories;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Articles;
use App\User;
use Illuminate\Support\Facades\Session;

class BlogController extends Controller
{
    /*
     * All articles list page
     */
    public function index()
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
        $article = new Articles;

        $article->user_id = $request->user()->id;
        $article->title = $request->title;
        $article->content = $request->articleContent;
        $article->status_id = $request->status_id;

        if($article->save()){
            if($request->category) {
                $article->categories()->sync($request->category);
            }
            Session::flash('flash_message', 'Статья успешно создана');
            return back();
        }
        else{
            return Redirect::back()->withErrors($article->errors());
        }
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

        return view('blog.edit', compact('article', 'data'));
    }

    /*
     * Updating existing article
     */
    public function update(Request $request, Articles $article)
    {
        $article->user_id = $request->user()->id;
        $article->title = $request->title;
        $article->content = $request->articleContent;
        $article->status_id = $request->status_id;

        if($article->update()){
            if($request->category) {
                $article->categories()->sync($request->category);
            }
            Session::flash('flash_message', 'Статья успешно сохранена');
            return back();
        }
        else{
            return Redirect::back()->withErrors($article->errors());
        }

        return back();
    }

    /*
     * Categories list page
     */
    public function categories()
    {
        $categories = new Categories;

        $data = [
            'categories' => $categories->get_with_parent(),
        ];

        return view('blog.categories', compact('data'));
    }

    /*
     * Creates new category
     */
    public function create_category(Request $request)
    {
        $has_parent = false;
        if(!$request->parent_id == 0) $has_parent = true;
        if(Categories::create([
            'name' => $request->title,
            'parent_id' => $request->parent_id,
            'has_parent' => $has_parent,
        ])) Session::flash('flash_message', 'Категория успешно создана');

        return back();
    }
}
