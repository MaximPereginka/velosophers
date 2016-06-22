<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    /*
     * Relation with articles
     */
    public function articles()
    {
        return $this->hasMany('App\Models\Articles');
    }
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'user_type', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'remember_token',
    ];
    
    /*
     * Relation with user_type
     */
    public function type()
    {
        return $this->belongsTo('App\Models\User_Type', 'user_type', 'id');
    }

    /*
     * Changes password of the current user
     */
    public function update_password($current, $new)
    {
        if(Hash::check($current, $this->password)){
            $this->password = Hash::make($new);
            if($this->update()){
                Session::flash('flash_message_text', 'Пароль успешно изменён');
                Session::flash('flash_message_class', 'success');
            }
            else {
                Session::flash('flash_message_text', 'Ошибка изменения пароля');
                Session::flash('flash_message_class', 'danger');
            }
        }
        else {
            Session::flash('flash_message_text', 'Новый и старый пароли не совпадают');
            Session::flash('flash_message_class', 'danger');
        }
    }

    /*
     * Relation with categories for moderators
     */
    public function moderated_categories()
    {
        return $this->belongsToMany('App\Models\Categories', 'moderator_category', 'moderator_id', 'category_id');
    }

    /*
     * Receive request data
     * Creates new user
     */
    public function create_user($request)
    {
        $this->name = $request->username;
        $this->email = $request->email;
        $this->user_type = $request->type;
        $this->password = Hash::make($request->password);

        if($this->save()){
            Session::flash('flash_message_text', 'Пользователь успешно создан');
            Session::flash('flash_message_class', 'success');
            return redirect('/dashboard/author/users/' . $this->id);
        }
        else {
            Session::flash('flash_message_text', 'Ошибка создания пользователя');
            Session::flash('flash_message_class', 'danger');
            return back();
        }
    }

    /*
     * Receive request data
     * Creates new user
     */ 
    public function update_user($request)
    {
        $this->name = $request->username;
        $this->email = $request->email;
        $this->user_type = $request->type;
        if(($this->user_type == 3) && ($request->moderator_category_)) $this->moderated_categories()->sync($request->moderator_category_);

        if($this->update()){
            Session::flash('flash_message_text', 'Информация о пользователе успешно обновлена');
            Session::flash('flash_message_class', 'success');
        }
        else {
            Session::flash('flash_message_text', 'Ошибка обновления информации о пользователе');
            Session::flash('flash_message_class', 'danger');
        }
        return back();
    }

    /*
     * Deletes user and all his relations
     */
    public function delete_user()
    {
        if($this->moderated_categories()) $this->moderated_categories()->detach();

        if($this->delete()){
            Session::flash('flash_message_text', 'Пользователь успешно удалён');
            Session::flash('flash_message_class', 'success');
            return redirect('/dashboard/author/users');
        }
        else {
            Session::flash('flash_message_text', 'Ошибка удаления пользователя');
            Session::flash('flash_message_class', 'danger');
            return back();
        }
    }
}
