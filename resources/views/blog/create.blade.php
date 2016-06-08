@extends('layouts.administrator')

@section('content')
    <div class="page-header">
        <h1>Создание статьи</h1>
    </div>
    <form action="/administrator/blog" method="post">
        <div class="col-md-8">
            <div class="form-group">
                <label class="control-label" for="title">Название</label>
                <input type="text" id="title" name="title" class="form-control" placeholder="Введите название статьи" />
            </div>
            <div class="form-group">
                <label class="control-label" for="articleContent">Текст статьи</label>
                <textarea id="articleContent" name="articleContent" class="form-control"></textarea>
            </div>
        </div>
        <div class="col-md-4">
            <label class="control-label">&nbsp; </label>
            <div class="panel panel-default">
                <div class="panel-heading">Категории</div>
                <div class="panel-body">
                    @foreach($data['categories'] as $category)
                    <div class="checkbox">
                        <label for="category_id">
                            <input name="category[]" id="category_{{ $category->id }}" value="{{ $category->id }}" class="checkbox" type="checkbox">
                            {{ $category->name }}
                        </label>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Создать</button>
                <button type="reset" class="btn btn-default">Очистить</button>
            </div>
        </div>

        <input type="hidden" name="_token" value="{{ csrf_token() }}">
    </form>

    @include('helpers.tinymce')
@stop