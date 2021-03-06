<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    /*
     * Dashboard home page
     */
    public function index()
    {
        if(Auth::user()->user_type == 2) {
            return view('dashboard.author.home');
        }
        else if (Auth::user()->user_type == 3) {
            return view('dashboard.moderator.home');
        }
        else if (Auth::user()->user_type == 4) {
            return view('dashboard.administrator.home');
        }
        else if (Auth::user()->user_type == 5) {
           return view('dashboard.author-moderator.home');
        }
        else {
            return "Ты блять кто вообще?";
        }
    }

    /*
     * Displays private office page for current user
     */
    public function private_office()
    {
        if(Auth::user()->user_type == 4) return redirect('/dashboard/author/users/'. Auth::user()->id);
        
        return view('dashboard.mutual.private_office');
    }
    
    /*
     * Updating current user information
     */
    public function user_update(Request $request)
    {
        $this->validate($request, [
            'username' => 'max:255|required|unique:users,name,'.Auth::user()->id,
            'email' => 'max:255|required|unique:users,email,'.Auth::user()->id,
        ]);

        Auth::user()->name = $request['username'];
        Auth::user()->email = $request['email'];

        if(Auth::user()->update()) {
            Session::flash('flash_message_text', 'Личные данные успешно обновлены');
            Session::flash('flash_message_class', 'success');
            return back();
        }
        else {
            Session::flash('flash_message_text', 'Ошибка обновления личных данных');
            Session::flash('flash_message_class', 'danger');
            return back();
        }
    }

    /*
     * Updating current user password
     */
    public function user_update_password(Request $request)
    {
        $this->validate($request, [
            'current' => 'required|max:255|min:6',
            'password' => 'confirmed|max:255|min:6',
        ]);

        Auth::user()->update_password($request['current'], $request['password']);
        return back();
    }
}
