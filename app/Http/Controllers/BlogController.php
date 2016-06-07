<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Articles;
use App\User;

class BlogController extends Controller
{
    /*
     * All articles list page
     */
    public function index()
    {
        $articles = Articles::all();
        return view('blog.administrator_index', compact('articles'));
    }
    
    /*
     * List of current user articles page
     */
    public function own(){
        $user = new User;
        $articles = $user->find(\Auth::user()->id)->articles;

        return view('blog.administrator_index', compact('articles'));
    }
    
    /*
     * Creating article page
     */
    public function create()
    {
        $categories = new Categories();
        $data = [
            'categories' => $categories->all(),
        ];

        return view('blog.create', compact('data'));
    }

    /*
     * Saving new article
     */
    public function store(Request $request)
    {
        Articles::create([
            'user_id' => $request->user()->id,
            'title' => $request->title,
            'content' => $request->articleContent,
            'category_id' => '1',
        ]);

        return back();
    }

    /*
     * Editing existing article page
     */

    public function edit(Articles $article)
    {
        $categories = new Categories();
        $data = [
            'categories' => $categories->all(),
        ];

        return view('blog.edit', compact('article', 'data'));
    }

    /*
     * Updating existing article
     */
    public function update(Request $request, Articles $article)
    {
        $article->update([
            'user_id' => $request->user()->id,
            'title' => $request->title,
            'content' => $request->articleContent,
            'category_id' => $request->category_id,
        ]);

        return back();
    }
}
