@extends('layouts.administrator')

@section('content')

    <div class="page-header col-md-12">
        <h1>Категория &laquo;{{ $category->name }}&raquo;</h1>
    </div>

    @if(empty($articles))

        <div class="col-md-12">
            <p>Не создано ни одной статьи</p>
        </div>

    @else

        <!-- Article list -->
        @include('helpers.administrator.article_list')

    @endif

@stop