@extends('layouts.administrator')

@section('content')

    <div class="page-header">
        <h1>Создание статьи</h1>
    </div>
    <form action="/administrator/blog" method="post">
        <div class="form-group">
            <label class="control-label" for="title">Название</label>
            <input type="text" id="title" name="title" class="form-control" placeholder="Введите название статьи" />
        </div>

        <div class="form-group">
            <label class="control-label" for="category_id">Категория</label>
            <select id="category_id" name="category_id" class="form-control" required>
                @foreach($data['categories'] as $category)
                    <option value="{{ $category->id }}" @if($category->id == 1) {{ "selected" }}@endif>{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label class="control-label" for="articleContent">Текст статьи</label>
            <textarea id="articleContent" name="articleContent" class="form-control"></textarea>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Создать</button>
            <button type="reset" class="btn btn-default">Очистить</button>
        </div>

        <input type="hidden" name="_token" value="{{ csrf_token() }}">
    </form>

    @include('helpers.tinymce')
@stop