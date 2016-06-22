@extends('layouts.dashboard')

@section('content')
    @include('helpers.dashboard.mutual.home.header')

    <div class="row">
        <div class="col-md-3">
            <div class="row">
                <div class="col-md-6">
                    <a href="/dashboard/administrator/articles/create" title="Создать статью">Создать статью</a>
                </div>
                <div class="col-md-6">
                    <a href="/dashboard/administrator/articles/own" title="Мои статьи">Мои статьи</a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <a href="/dashboard/administrator/articles" title="Все статьи">Все статьи</a>
                </div>
                <div class="col-md-6">
                    <a href="/dashboard/administrator/moderation_list" title="Модерация статтей">Модерация статтей</a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <a href="/dashboard/administrator/articles/categories" title="Категории статтей">Категории статтей</a>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-md-offset-1">
            <div class="row">
                @include('helpers.dashboard.mutual.home.private_office')
                <div class="col-md-6">
                    <a href="/dashboard/author/users" title="Список пользователей">Список пользователей</a>
                </div>
            </div>
        </div>
    </div>
@stop