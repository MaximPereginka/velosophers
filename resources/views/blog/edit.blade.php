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
            <div class="panel panel-default">
                <div class="panel-heading">Детали</div>
                <div class="panel-body">
                    <p><b>Автор:</b> {{ $article->user->name }}</p>

                    <!-- Article status -->
                    @include('helpers.administrator.article_status_select')

                    <p><b>Дата создания: </b> {{ $article->created_at->format('d.m.o') }}</p>
                </div>
            </div>

            <!-- Article categories -->
            @include('helpers.administrator.article_categories')

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Сохранить</button>
            </div>
        </div>

        <input type="hidden" name="_token" value="{{ csrf_token() }}">
    </form>

    @include('helpers.tinymce')
@stop