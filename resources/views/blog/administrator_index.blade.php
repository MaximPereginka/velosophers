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

            @include('helpers.administrator_article_list')

        @endforeach

    @endif

@stop