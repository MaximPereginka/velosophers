@extends('layouts.dashboard')

@section('content')
    <div class="page-header">
        <h1>Последние публикации</h1>
    </div>
    @if($data['articles']->isEmpty())
        <p>Нет новых публикаций</p>
    @else
        <div class="list-group">
        @foreach($data['articles'] as $article)
                <a href="/article/{{ $article->id }}" class="list-group-item">
                    <h4 class="list-group-item-heading">{{ $article->title }}</h4>
                    <div class="list-group-item-text">
                        <div class="row">
                            <div class="col-md-2">
                                <img style="width: 100%" class="thumbnail" alt="{{ $article->title }}" src="{{ ($article->img) ? $article->img : "/img/dashboard/no-image.png" }}" />
                            </div>
                            <div class="col-md-10">
                                {{ $article->preview }}
                            </div>
                        </div>
                    </div>
                </a>
        @endforeach
        </div>
    @endif
@stop