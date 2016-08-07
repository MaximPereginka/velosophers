@extends('layouts.dashboard')

@section('content')
    @include('helpers.dashboard.author.reject_message')

    <div class="page-header">
        <h1>Редактирование статьи &laquo;{{ $data['article']->title }}&raquo;</h1>
    </div>

    <form action="/dashboard/administrator/articles/{{ $data['article']->id }}/update" method="post">
    {{ csrf_field() }}
    {{ method_field('PATCH') }}

    <!-- Title, preview and article text -->
        @include('helpers.dashboard.author.article_content')

        <div class="col-md-3">
            <label class="control-label">&nbsp;</label>

            <div class="form-group">
                <button type="submit" class="form-control btn btn-primary">Обновить статью</button>
            </div>

            <div class="form-group">
                <a target="_blank" href="/dashboard/administrator/articles/{{ $data['article']->id }}/preview" title="Предварительный просмотр" class="form-control btn btn-default">Предварительный просмотр</a>
            </div>

            <div class="form-group">
                <a onclick="show_modal('delete_article')" href="#" title="Удалить" class="form-control btn btn-danger">Удалить</a>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">Подробности</div>
                <div class="panel-body">
                    <p><b>Дата создания: </b>{{ $data['article']->created_at->format('d.m.o') }}</p>
                    <p><b>Автор: </b> {!! (is_null($data['article']->user)) ? "Velosopjers" : "<a href=\"/dashboard/author/users/" . $data['article']->user->id . "\" title=\"" . $data['article']->user->name . "\">" . $data['article']->user->name . "</a>" !!}</p>

                    <!-- Article status selection -->
                    @include('helpers.dashboard.administrator.article_status')
                    <p><b>Просмотры: </b>{{ $data['article']->views }}</p>
                    <p><b>Лайки: </b>{{ $data['article']->likes }}</p>
                    <p><b>Комментарии: </b>{{ count($data['article']->comments) }}</p>
                </div>
            </div>

            <!-- Categories selection -->
            @include('helpers.dashboard.author.article_categories')

            <!-- Article image -->
            @include('helpers.dashboard.author.article_image')

        </div>
    </form>

    <!-- Modal window -->
    @include('helpers.dashboard.author.delete_article')

    @include('helpers.dashboard.mutual.tinymce')
@stop