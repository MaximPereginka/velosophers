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

        <!-- Article list -->
        @include('helpers.administrator.article_list')

    @endif

@stop