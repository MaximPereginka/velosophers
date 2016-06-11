@extends('layouts.administrator')

@section('content')
    <div class="page-header">
        <h1>Пользователь &laquo;{{ $data['user']->name }}&raquo;</h1>
    </div>
    <div class="col-md-4">
        <div class="row">
            <form action="/administrator/users/{{ $data['user']->id }}/update" method="post">
                {{ method_field('PATCH') }}

                <!-- User edit form -->
                @include('helpers.administrator.user_edit')

                <div class="form-group">
                    <button class="btn btn-primary" type="submit">Сохранить</button>
                    <a href="/administrator/users/{{ $data['user']->id }}/delete" class="btn btn-danger" title="Удалить">Удалить</a>
                </div>
            </form>
        </div>
        <div class="row">
            <form action="/administrator/users/{{ $data['user']->id }}/password" method="post">
                {{ method_field('PATCH') }}
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group">
                    <h2>Смена пароля</h2>
                </div>

                <div class="form-group">
                    <label for="old_pass" class="control-label">Старый пароль</label>
                    <input type="password" class="form-control" id="old_pass" name="old_pass" placeholder="Введите старый пароль">
                </div>

                <div class="form-group">
                    <label for="new_pass" class="control-label">Новый пароль</label>
                    <input type="password" class="form-control" id="new_pass" name="new_pass" placeholder="Введите новый пароль">
                </div>

                <div class="form-group">
                    <label for="new_again" class="control-label">Подтвердите новый пароль</label>
                    <input type="password" class="form-control" id="new_again" name="new_again" placeholder="Подтвердите введите старый пароль">
                </div>

                <div class="form-group">
                    <button class="btn btn-primary" type="submit">Сменить пароль</button>
                </div>
            </form>
        </div>
    </div>
    <div class="col-md-offset-2 col-md-6">
        <h2>Последние публикации</h2>
        @if(!$data['user']->articles->isEmpty())
            <div class="list-group">
            @foreach($data['user']->articles->sortByDesc('created_at')->slice(0, 5) as $article)
                <a href="/administrator/blog/view/{{ $article->id }}" class="list-group-item">
                    <h4 class="list-group-item-heading">{{ $article->title }}</h4>
                    <div class="row">
                        <div class="col-md-4">
                            <img style="width: 100%" class="thumbnail" src="{{ ($article->img) ? $article->img : "/img/administrator/no-image.png" }}" alt="{{ $article->title }}" />
                        </div>
                        <div class="col-md-8">
                            <p class="list-group-item-text">{{ $article->preview }}</p>
                        </div>
                    </div>
                </a>
            @endforeach
            </div>
        @else
            <p>Пользователь ещё не создал ни одной статьи</p>
        @endif
    </div>
@stop