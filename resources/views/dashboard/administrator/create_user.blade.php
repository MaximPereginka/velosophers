@extends('layouts.dashboard')

@section('content')
    <div class="page-header">
        <h1>Создание нового пользователя</h1>
    </div>
    <div class="col-md-4">
        <div class="row">
            <form method="post" action="/dashboard/author/users/store">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="username" class="control-label">Имя пользователя</label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Ведите имя пользователя" value="{{ old('username') }}">
                </div>
                <div class="form-group">
                    <label for="email" class="control-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Ведите email пользователя" value="{{ old('email') }}">
                </div>
                <div class="form-group">
                    <label for="type" class="control-label">Тип пользователя</label>
                    <select class="form-control" id="type" name="type">
                        @foreach($data['user_type'] as $type)
                            <option value="{{ $type->id }}"
                            @if(old('type') && (old('type') == $type->id))
                                selected
                            @endif
                            >{{ $type->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="password" class="control-label">Пароль</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Ведите пароль">
                </div>
                <div class="form-group">
                    <label for="password_confirmation" class="control-label">Подтвердите пароль</label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Подтвердите пароль">
                </div>
                <div class="form-group">
                    <button type="submit" class="form-control btn btn-success">Создать</button>
                </div>
            </form>
        </div>
    </div>
@stop