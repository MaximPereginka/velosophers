@extends('layouts.administrator')

@section('content')

    <div class="page-header">
        <h1>Создание статьи</h1>
    </div>
    <form action="" method="post">
        <div class="form-group">
            <label class="control-label" for="caption">Название</label>
            <input type="text" id="caption" name="caption" class="form-control" placeholder="Введите название статьи" />
        </div>
    </form>

@stop