@extends('layouts.administrator')

@section('content')

    <div class="page-header">
        <h1>Редактирование статьи</h1>
    </div>
    <form action="/administrator/blog/edit/{{ $article->id }}/update" method="post">

        {{ method_field('PATCH') }}
        <p><b>Автор:</b> {{ $article->user->name }}</p>

        <div class="form-group">
            <label class="control-label" for="title">Название</label>
            <input value="{{ $article->title }}" type="text" id="title" name="title" class="form-control" placeholder="Введите название статьи" />
        </div>


        <div class="form-group">
            <label class="control-label" for="category_id">Категория</label>
            <select id="category_id" name="category_id" class="form-control" required>
                @foreach($data['categories'] as $category)
                    <option value="{{ $category->id }}" @if($category->id == $article->category->id) {{ "selected" }}@endif>{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label class="control-label" for="articleContent">Текст статьи</label>
            <textarea id="articleContent" name="articleContent" class="form-control">{{ $article->content }}</textarea>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Сохранить</button>
        </div>

        <input type="hidden" name="_token" value="{{ csrf_token() }}">
    </form>

    @include('helpers.tinymce')
@stop