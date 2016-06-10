@extends('layouts.administrator')

@section('content')
    <div class="page-header">
        <h1>Создание статьи</h1>
    </div>
    <form action="/administrator/blog" method="post">
        <div class="col-md-8">
            <!-- Article content -->
            @include('helpers.administrator.article_content')

        </div>
        <div class="col-md-4">
            <!-- Article status-->
            @include('helpers.administrator.article_status_select')

            <!-- Article categories -->
            @include('helpers.administrator.article_categories')

            <!-- Article image -->
            @include('helpers.administrator.article_image')

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Создать</button>
            </div>
        </div>

        <input type="hidden" name="_token" value="{{ csrf_token() }}">
    </form>

    @include('helpers.tinymce')
@stop