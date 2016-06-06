@extends('layouts.administrator')

@section('content')

    <h1>{{ $article->title }}</h1>
    <p>{!! $article->content !!}</p>
    <p><b>Автор:</b> {{ $article->user->name }}</p>
@stop