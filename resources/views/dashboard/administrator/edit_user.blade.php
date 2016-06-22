@extends('layouts.dashboard')

@section('content')
    <div class="page-header">
        <h1>Редактирование пользователя &laquo;{{ $data['user']->name }}&raquo;</h1>
    </div>
    <div class="col-md-4">
        <div class="row">
            <form method="post" action="/dashboard/author/users/{{ $data['user']->id }}/update">
                {{ csrf_field() }}
                {{ method_field('PATCH') }}
                <div class="form-group">
                    <label for="username" class="control-label">Имя пользователя</label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Ведите имя пользователя" value="{{ (old('username')) ? old('username') : $data['user']->name }}">
                </div>
                <div class="form-group">
                    <label for="email" class="control-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Ведите email пользователя" value="{{ (old('email')) ? old('email') : $data['user']->email}}">
                </div>
                <div class="form-group">
                    <label for="type" class="control-label">Тип пользователя</label>
                    <select class="form-control" id="type" name="type">
                        @foreach($data['user_type'] as $type)
                            <option value="{{ $type->id }}"
                                    @if((old('type') && (old('type') == $type->id)) || ($type->id == $data['user']->user_type))
                                    selected
                                    @endif
                            >{{ $type->name }}</option>
                        @endforeach
                    </select>
                </div>
                <input type="hidden" value="{{ $data['user']->id }}" name="user_id">
                <div class="form-group">
                    <button type="submit" class="form-control btn btn-success">Обновить информацию</button>
                </div>
                <div class="form-group">
                    <a href="#" onclick="show_modal('delete_user')" title="Удалить пользователя" class="form-control btn btn-danger">Удалить пользователя</a>
                </div>
            </form>
        </div>
        <hr/>
        <div class="row">
            <form action="/dashboard/author/users/{{ $data['user']->id }}/change_password" method="post">
                <h2>Смена пароля</h2>
                {{ csrf_field() }}
                {{ method_field('PATCH') }}
                <div class="form-group">
                    <label for="password" class="control-label">Новый пароль</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Ведите новый пароль">
                </div>
                <div class="form-group">
                    <label for="password_confirmation" class="control-label">Подтвердите новый пароль</label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Подтвердите новый пароль">
                </div>
                <input type="hidden" value="{{ $data['user']->id }}" name="user_id">
                <div class="form-group">
                    <button type="submit" class="form-control btn btn-success">Обновить пароль</button>
                </div>
            </form>
        </div>
    </div>
    <div class="col-md-6 col-md-offset-2">
        <div class="row">
            @if(in_array($data['user']->user_type, [2,4]))
                <h2>Последние публикации</h2>
                @if($data['user']->articles->isEmpty())
                    <p>Не создано ни одной статьи</p>
                @else
                    @foreach($data['user']->articles()->orderBy('updated_at', 'desc')->get() as $article)
                        <div class="list-group">
                            <a href="/dashboard/administrator/articles/{{ $article->id }}/preview" class="list-group-item">
                                <h4 class="list-group-item-heading">{{ $article->title }}</h4>
                                <p class="list-group-item-text">{{ $article->preview }}</p>
                            </a>
                        </div>
                    @endforeach
                @endif
            @endif
        </div>
    </div>

    <div id="delete_user" class="modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button onclick="hide_modal('delete_user')" type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Удаление пользователя</h4>
                </div>
                <div class="modal-body">
                    <p>Вы действительно хотите удалить даного пользователя?</p>
                </div>
                <div class="modal-footer">
                    <button onclick="hide_modal('delete_user')" type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                    <a href="/dashboard/author/users/{{ $data['user']->id }}/delete" title="Удалить пользователя" class="btn btn-danger">Удалить</a>
                </div>
            </div>
        </div>
    </div>
@stop