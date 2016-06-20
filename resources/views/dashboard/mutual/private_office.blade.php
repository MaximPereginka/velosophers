@extends('layouts.dashboard')

@section('content')
    <div class="page-header">
        <h1>Личный кабинет</h1>
    </div>

    <div class="col-md-4">
        <div class="row">
            <form action="/dashboard/user/update" method="post">
                <h2>Обо мне</h2>

                {{ csrf_field() }}
                {{ method_field('PATCH') }}

                <div class="form-group">
                    <label for="username" class="control-label">Логин</label>
                    <input type="text" class="form-control" name="username" id="username" value="{{ (old('username')) ? old('username') : Auth::user()->name }}" placeholder="Введите логин">
                </div>

                <div class="form-group">
                    <label for="email" class="control-label">Email</label>
                    <input type="email" class="form-control" name="email" id="email" value="{{ (old('email')) ? old('email') : Auth::user()->email }}" placeholder="Введите email">
                </div>

                <div class="form-group">
                    <p class="control-label"><b>Тип пользователя: </b> {{ Auth::user()->type->name }}</p>
                </div>

                <div class="form-group">
                    <button class="form-control btn btn-primary" type="submit">Изменить данные</button>
                </div>

                <div class="form-group">
                    <a onclick="show_modal('delete_account')" href="#" title="Удалить аккаунт" class="form-control btn btn-danger" type="submit">Удалить аккаунт</a>
                </div>
            </form>
        </div>
        <hr/>
        <div class="row">
            <form action="/dashboard/user/update_password" method="post">
                <h2>Смена пароля</h2>

                {{ csrf_field() }}
                {{ method_field('PATCH') }}

                <div class="form-group">
                    <label for="current" class="control-label">Текущий пароль</label>
                    <input type="password" class="form-control" name="current" id="current" placeholder="Старый пароль">
                </div>

                <div class="form-group">
                    <label for="password" class="control-label">Текущий пароль</label>
                    <input type="password" class="form-control" name="password" id="password" placeholder="Новый пароль">
                </div>

                <div class="form-group">
                    <label for="password_confirmation" class="control-label">Подтвердите новый пароль</label>
                    <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Подтвердите новый пароль">
                </div>

                <div class="form-group">
                    <button class="form-control btn btn-primary" type="submit">Сменить пароль</button>
                </div>
            </form>
        </div>
    </div>

    <div class="col-md-6 col-md-offset-2">
        <div class="row">
            @if(in_array(Auth::user()->user_type, [2,4]))
                <h2>Последние публикации</h2>
                @if(Auth::user()->articles->isEmpty())
                    <p>Не создано ни одной статьи</p>
                @else
                    @foreach(Auth::user()->articles()->orderBy('updated_at', 'desc')->get() as $article)
                        <div class="list-group">
                            <a href="/dashboard/author/articles/{{ $article->id }}/preview" class="list-group-item">
                                <h4 class="list-group-item-heading">{{ $article->title }}</h4>
                                <p class="list-group-item-text">{{ $article->preview }}</p>
                            </a>
                        </div>
                    @endforeach
                @endif
            @endif
        </div>
    </div>

    <!-- Modal window -->
    <div id="delete_account" class="modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button onclick="hide_modal('delete_account')" type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Удаление статьи</h4>
                </div>
                <div class="modal-body">
                    <p>Вы действительно хотите удалить данную статью?</p>
                </div>
                <div class="modal-footer">
                    <button onclick="hide_modal('delete_account')" type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                    <a href="/dashboard/user/delete" title="Удалить аккаунт" class="btn btn-danger">Удалить аккаунт</a>
                </div>
            </div>
        </div>
    </div>
@stop