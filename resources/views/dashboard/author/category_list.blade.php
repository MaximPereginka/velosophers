@extends('layouts.dashboard')

@section('content')
    <div class="page-header">
        <h1>Мои статьи категории &laquo;{{ $data['category'] }}&raquo;</h1>
    </div>

    <!-- Articles list -->
    @include('helpers.dashboard.author.article_list')
@stop