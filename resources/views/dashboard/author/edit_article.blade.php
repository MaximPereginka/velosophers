@extends('layouts.dashboard')

@section('content')
    <div class="page-header">
        <h1>Редактирование статьи &laquo;{{ $data['article']->title }}&raquo;</h1>
    </div>

    <form action="/dashboard/author/articles/{{ $data['article']->id }}/update" method="post">
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
                <a target="_blank" href="/dashboard/author/articles/{{ $data['article']->id }}/preview" title="Предварительный просмотр" class="form-control btn btn-default">Предварительный просмотр</a>
            </div>

            <div class="form-group">
                <a onclick="show_modal('delete_article')" href="#" title="Удалить" class="form-control btn btn-danger">Удалить</a>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">Подробности</div>
                <div class="panel-body">
                    <p><b>Дата создания: </b>{{ $data['article']->created_at->format('d.m.o') }}</p>
                    <p><b>Статус: </b>{{ $data['article']->status->name }}</p>
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