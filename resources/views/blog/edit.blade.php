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
            <div class="form-group">
                <label class="control-label" for="title">Название</label>
                <input value="{{ $article->title }}" type="text" id="title" name="title" class="form-control" placeholder="Введите название статьи" />
            </div>
            <div class="form-group">
                <label class="control-label" for="articleContent">Текст статьи</label>
                <textarea id="articleContent" name="articleContent" class="form-control">{{ $article->content }}</textarea>
            </div>
        </div>
        <div class="col-md-4">
            <label>&nbsp;</label>
            <div class="panel panel-default">
                <div class="panel-heading">Детали</div>
                <div class="panel-body">
                    <p><b>Автор:</b> {{ $article->user->name }}</p>
                    <p><b>Статус: </b></p>
                    <p><b>Дата создания: </b> {{ $article->created_at->format('d.m.o') }}</p>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">Категории</div>
                <div class="panel-body">
                    @foreach($data['categories'] as $category)
                        <div class="checkbox">
                            <label for="category_id">
                                <input name="category[]" id="category_{{ $category->id }}" value="{{ $category->id }}" class="checkbox" type="checkbox"
                                @foreach($article->categories->all() as $article_cat)
                                    @if($article_cat->id == $category->id)
                                        {{ "checked" }}
                                    @endif
                                @endforeach
                                >
                                {{ $category->name }}
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Сохранить</button>
            </div>
        </div>

        <input type="hidden" name="_token" value="{{ csrf_token() }}">
    </form>

    @include('helpers.tinymce')
@stop