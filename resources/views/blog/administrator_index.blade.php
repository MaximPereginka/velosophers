@extends('layouts.administrator')

@section('content')

    <div class="page-header col-md-12">
        <h1>Все публикации</h1>
    </div>
    
    @if(empty($articles))

        <p>Не создано ни одной статьи</p>

    @endif
    @foreach($articles as $article)

        <div class="col-md-12">
            <h2><a href="/administrator/blog/edit/{{ $article->id }}">{{ $article->title }}</a></h2>
            <div class="content">
                {!! $article->content !!}
            </div>
        </div>

    @endforeach

@stop