<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Models\User_Type;
use App\Http\Requests;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /*
     * List of user page
     */
    public function index()
    {
        
        $users = new User;
        $data = [
            'users' => $users->all(),
        ];
        
        return view('users.index', compact('data'));
    }
    
    /*
     * Creating new user
     */
    public function create()
    {
        $user_type = new User_Type;

        $data = [
            'user_type' => $user_type->all(),
        ];

        return view('users.create', compact('data'));
    }

    /*
     * Saving new user
     */
    public function store(Request $request)
    {
        $user = new User;

        $this->validate($request, [
            'username' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'user_type' => 'required|integer',
            'password' => 'required|min:6',
        ]);

        $user->name = $request->username;
        $user->email = $request->email;
        $user->user_type = $request->user_type;
        $user->password = \Hash::make($request->password);

        if($user->save()){
            Session::flash('flash_message', 'Пользователь упешно создан');
            Session::flash('flash_message_level', 'success');
            return \Redirect::to('/administrator/users/edit/' . $user->id);
        }
        else {
            Session::flash('flash_message', 'Ошибка создания пользователя');
            Session::flash('flash_message_level', 'danger');
            return back();
        }
    }

    /*
     * Editing existing user page
     */
    public function edit(User $user)
    {
        $user_type = new User_Type();

        $data = [
            'user' => $user,
            'user_type' => $user_type->all(),
        ];
        
        return view('users.edit', compact('data'));
    }
    
    /*
     * Updating existing user
     */ 
    public function update(User $user, Request $request)
    {
        /*
         * Validation
         */
        $this->validate($request, [
            'username' => 'required|max:255',
            'email' => 'required|email|max:255',
            'user_type' => 'required|integer'
        ]);

        $user->name = $request->username;
        $user->email = $request->email;
        $user->user_type = $request->user_type;

        if($user->save()){
            Session::flash('flash_message', 'Информация о пользователе успешно обновлена');
            Session::flash('flash_message_level', 'success');
            return back();
        }
        else {
            return Redirect::back()->withErrors($user->errors());
        }
    }
    
    /*
     * Deleting existing user
     */
    public function delete(User $user)
    {
        if($user->delete()){
            Session::flash('flash_message', 'Пользователь успешно удалён');
            Session::flash('flash_message_level', 'success');
            return \Redirect::to('/administrator/users');
        }
        else {
            return \Redirect::back()->withErrors($user->errors);
        }
    }

    /*
     * Changing user password
     */
    public function password(User $user, Request $request)
    {
        $this->validate($request, [
            'old_pass' => 'required|max:255',
            'new_pass' => 'required|max:255',
            'new_again' => 'required|max:255',
        ]);

        if($request->new_pass === $request->new_again){
            if(\Hash::check($request->old_pass, $user->password)){
                $user->password = \Hash::make($request->new_again);
                if($user->update()){
                    Session::flash('flash_message', 'Пароль успешно изменён');
                    Session::flash('flash_message_level', 'success');

                }
                else {
                    Session::flash('flash_message', 'Не удалось изменить пароль');
                    Session::flash('flash_message_level', 'danger');
                }
            }
            else {
                Session::flash('flash_message', 'Новый и старый пароли не совпадают');
                Session::flash('flash_message_level', 'danger');
            }
        }
        else {
            Session::flash('flash_message', 'Новый пароль повторно введён неправильно');
            Session::flash('flash_message_level', 'danger');
        }
        return back();
    }
}
