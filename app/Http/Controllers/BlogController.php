<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Articles;
use DB;

class BlogController extends Controller
{
    /*
     * All articles list page
     */
    public function index(Request $request)
    {
        $articles = Articles::all();

        return view('blog.administrator_index', compact('articles'));
    }
    
    /*
     * Creating article page
     */
    public function create()
    {
        return view('blog.create');
    }

    /*
     * Editing existing article page
     */
    public function edit(Articles $article)
    {
        return view('blog.edit', compact('article'));
    }

    /*
     * Saving new article
     */
    public function store(Request $request)
    {
        $article = new Articles([
            'user_id' => $request->user()->id,
            'title' => $request->title,
            'content' => $request->articleContent,
        ]);

        $article->save();

        return back();
    }
}
