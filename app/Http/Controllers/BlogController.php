<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class BlogController extends Controller
{
    /*
     * Creating article page
     */
    public function create(){
        return view('blog.create');
    }
}
