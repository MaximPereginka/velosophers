@extends('layouts.administrator')

@section('content')
    @include('helpers.dashboard.mutual.home.header')

    <div class="row">
        <div class="col-md-3">
            <div class="row">
                <div class="col-md-6">
                    <a href="/dashboard/author/articles/new" title="Создать статью">Создать статью</a>
                </div>
                <div class="col-md-6">
                    <a href="/dashboard/author/articles/own" title="Мои статьи">Мои статьи</a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <a href="/dashboard/author/articles/new" title="Все статьи">Все статьи</a>
                </div>
            </div>
        </div>
    </div>
@stop