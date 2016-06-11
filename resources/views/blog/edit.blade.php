@extends('layouts.administrator')

@section('content')

    <div class="col-md-12">
        <div class="page-header">
            <h1>Редактирование статьи</h1>
        </div>
    </div>
    <form action="/administrator/blog/edit/{{ $article->id }}/update" method="post">

        {{ method_field('PATCH') }}
        <div class="col-md-8">
            <!-- Article content -->
            @include('helpers.administrator.article_content')
        </div>
        <div class="col-md-4">
            <label>&nbsp;</label>

            <div class="form-group">
                <a target="_blank" class="btn btn-default" href="/administrator/blog/view/{{ $article->id }}" title="{{ $article->title }}">Предварительный просмотр</a>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Сохранить</button>
                <a class="btn btn-danger" href="/administrator/blog/article/{{ $article->id }}/delete">Удалить</a>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">Детали</div>
                <div class="panel-body">
                    <p><b>Автор: </b>{{ (isset($article->user->name)) ? $article->user->name : "Velosophers"}}</p>
                    @if(!isset($article->user->name) and (!$data['users']->isEmpty()))
                        <div class="form-group">
                            <label for="user_id" class="control-label">Назначить нового пользователя</label>
                            <select class="form-control" id="user_id" name="user_id">
                                <option value="">Выберите нового пользователя</option>
                                @foreach($data['users'] as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    @endif

                    <!-- Article status -->
                    @include('helpers.administrator.article_status_select')

                    <p><b>Дата создания: </b> {{ $article->created_at->format('d.m.o') }}</p>
                </div>
            </div>

            <!-- Article categories -->
            @include('helpers.administrator.article_categories')


            <!-- Article image -->
            @include('helpers.administrator.article_image')
        </div>

        <input type="hidden" name="_token" value="{{ csrf_token() }}">
    </form>

    @include('helpers.tinymce')
@stop