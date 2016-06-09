<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class PagesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /*
     * Control panel home page
     */
    public function administrator_index(){
        return view('pages.administrator_index');
    }
}
