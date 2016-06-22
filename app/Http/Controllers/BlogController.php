<?php

namespace App\Http\Controllers;

use App\Models\Articles;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Session;

class BlogController extends Controller
{
    /*
     * List of last published articles
     */
    public function index()
    {
        $data = [
            'articles' => Articles::all()->where('status_id', 2),
        ];
        return view('blog.main', compact('data'));
    }
    
    /*
     * Article page
     */
    public function view(Articles $article)
    {
        if($article->status_id != 2){
            Session::flash('flash_message_text', 'Вы не можете просматривать данную статью');
            Session::flash('flash_message_class', 'danger');
            return back();
        }
        else {
            $data = [
                'article' => $article,
            ];
            return view('blog.view', compact('data'));
        }
    }
}
