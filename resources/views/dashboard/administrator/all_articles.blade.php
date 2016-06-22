@extends('layouts.dashboard')

@section('content')
    <div class="page-header">
        <h1>Все публикации</h1>
    </div>

    <!-- Articles list -->
    @include('helpers.dashboard.administrator.article_list')
@stop