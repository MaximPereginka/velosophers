@extends('layouts.administrator')

@section('content')

    <div class="page-header">
        <h1>Создание статьи</h1>
    </div>
    <form action="" method="post">
        <div class="form-group">
            <label class="control-label" for="title">Название</label>
            <input type="text" id="title" name="title" class="form-control" placeholder="Введите название статьи" />
        </div>

        <div class="form-group">
            <label class="control-label" for="content">Текст статьи</label>
            <textarea id="content" name="content" class="form-control"></textarea>
        </div>
    </form>

@stop