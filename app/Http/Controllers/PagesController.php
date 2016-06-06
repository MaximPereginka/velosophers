<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class PagesController extends Controller
{
    /*
     * Control panel home page
     */
    public function administrator_index(){
        return view('pages.administrator_index');
    }
}
