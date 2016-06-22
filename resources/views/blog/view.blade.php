@extends('layouts.dashboard')

@section('content')
    <div class="page-header">
        <h1>{{ $data['article']->title }}</h1>
    </div>
    <div class="content">
        {!! $data['article']->content !!}
    </div>
    <p><b>Автор: </b>{{ $data['article']->user->name }}</p>
    <p><b>Дата публикации: </b>{{ $data['article']->updated_at->format('d.m.o.') }}</p>
@stop