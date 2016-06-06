@extends('layouts.administrator')

@section('content')

    <div class="page-header col-md-12">
        <h1>Панель управления</h1>
    </div>
    <div class="row">
        <div class="col-md-3">
            <div class="col-md-12">
                <h2>Блог</h2>
            </div>
            <div class="col-lg-6">
                <a href="/administrator/blog/create" >Создать статью</a>
            </div>
            <div class="col-lg-6">
                <a href="#" >Все статьи</a>
            </div>
            <div class="col-lg-6">
                <a href="#" >Мои статьи</a>
            </div>
        </div>
    </div>

@stop