@extends('layouts.administrator')

@section('content')
    <div class="page-header col-md-12">
        <h1>{{ $article->title }}</h1>
    </div>
    <div class="content col-md-9">
        {!! $article->content !!}
    </div>
    <div class="col-md-3">
        <div class="panel panel-default">
            <div class="panel-heading">Подробности</div>
            <div class="panel-body">
                @if($article->img)
                    <img width="100%" class="thumbnail" src="{{ $article->img }}" alt="{{ $article->title }}" />
                @endif
                <div class="details">
                    <p><b>Автор: </b>{{ $article->user->name }}</p>
                    <p style="line-height: 25px"><b>Категории: </b>
                        @if($article->categories)
                            @foreach($article->categories as $category)
                                <a target="_blank" class="btn btn-xs btn-success" href="/administrator/blog/category/{{ $category->id }}" alt="{{ $category->name }}">{{ $category->name }}</a>
                            @endforeach
                        @endif
                    </p>
                    <p><b>Дата создания: </b>{{ $article->created_at->format('d.m.o') }}</p>
                    <p><a style="width: 100%" class="btn btn-primary" href="/administrator/blog/edit/{{ $article->id }}" alt="{{ $article->title }}">Редактировать</a></p>
                </div>
            </div>
        </div>
    </div>
@stop