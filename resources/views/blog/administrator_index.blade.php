@extends('layouts.administrator')

@section('content')

    <div class="page-header col-md-12">
        <h1>Все публикации</h1>
    </div>

    @if($articles->isEmpty())

        <div class="col-md-12">
            <p>Не создано ни одной статьи</p>
        </div>

    @else

        @foreach($articles as $article)

            <div class="col-md-12">
                <h2><a href="/administrator/blog/edit/{{ $article->id }}">{{ $article->title }}</a></h2>
                <p><b>Автор: </b> {{ $article->user->name }}</p>
                <p><b>Категория: </b>{{ $article->category->name }}</p>
                <div class="content">
                    {!! $article->content !!}
                </div>
                <p><b>Дата создания: </b><time>{{ $article->created_at->format('d.m.o') }}</time></p>
            </div>

        @endforeach

    @endif

@stop