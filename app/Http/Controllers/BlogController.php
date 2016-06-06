<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use DB;
use App\Models\Article;

class BlogController extends Controller
{
    /*
     * All articles list page
     */
    public function index(){
        $articles = Article::all();

        return view('blog.administrator_index', compact('articles'));
    }
    
    /*
     * Creating article page
     */
    public function create(){
        return view('blog.create');
    }

    /*
     * Editing existing article page
     */
    public function edit($id){
        $article = Article::find($id);

        return view('blog.edit', compact('article'));
    }
}
