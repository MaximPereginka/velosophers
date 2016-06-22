@extends('layouts.dashboard')

@section('content')
    <div class="page-header">
        <h1>Создание статьи</h1>
    </div>

    <form action="/dashboard/administrator/articles/store" method="post">
    {{ csrf_field() }}

        <!-- Title, preview and article text -->
        @include('helpers.dashboard.author.article_content')

        <div class="col-md-3">
            <label class="control-label">&nbsp;</label>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Создать статью</button>
            </div>

            <!-- Article status selection -->
            @include('helpers.dashboard.administrator.article_status')

            <!-- Categories selection -->
            @include('helpers.dashboard.author.article_categories')

            <!-- Article image -->
            @include('helpers.dashboard.author.article_image')
        </div>
    </form>

    @include('helpers.dashboard.mutual.tinymce')
@stop