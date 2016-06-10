@extends('layouts.administrator')

@section('content')
    <div class="page-header">
        <h1>Создание нового пользователя</h1>
    </div>
    <div class="col-md-4">
        <div class="row">
            <form action="/administrator/users/store" method="post">

                <!-- User edit form -->
                @include('helpers.administrator.user_edit')

                <div class="form-group">
                    <label class="control-label" for="password">Пароль</label>
                    <input class="form-control" name="password" type="password" id="password" placeholder="Введите пароль">
                </div>

                <div class="form-group">
                    <button class="btn btn-primary" type="submit">Создать</button>
                </div>
            </form>
        </div>
    </div>
@stop