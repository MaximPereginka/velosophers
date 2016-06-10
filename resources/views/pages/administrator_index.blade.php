@extends('layouts.administrator')

@section('content')

    <div class="page-header col-md-12">
        <h1>Панель управления</h1>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="col-md-12">
                <h2>Блог</h2>
            </div>
            <div class="col-md-6">
                <a href="/administrator/blog/create" >Создать статью</a>
            </div>
            <div class="col-md-6">
                <a href="/administrator/blog" >Все статьи</a>
            </div>
            <div class="col-md-6">
                <a href="/administrator/blog/own" >Мои статьи</a>
            </div>
            <div class="col-md-6">
                <a href="/administrator/blog/categories">Категории</a>
            </div>
        </div>
        <div class="col-md-4">
            <div class="col-md-12">
                <h2>Пользователи</h2>
            </div>
            <div class="col-md-6">
                <a href="/administrator/users" >Все пользователи</a>
            </div>
            <div class="col-md-6">
                <a href="/administrator/users/edit/{{ Auth::user()->id }}" >Личный кабинет</a>
            </div>
            <div class="col-md-6">
                <a href="/administrator/users/create" >Добавить пользователя</a>
            </div>
        </div>
    </div>

@stop