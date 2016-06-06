@extends('layouts.administrator')

@section('content')

    <div class="page-header col-md-12">
        <h1>Все публикации</h1>
    </div>

    @foreach($articles as $article)

        <div class="col-md-12">
            <h2>{{ $article->title }}</h2>
            <div class="content">
                {{ $article->content }}
            </div>
        </div>

    @endforeach

@stop