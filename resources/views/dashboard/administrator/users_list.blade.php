@extends('layouts.dashboard')

@section('content')
    <div class="page-header">
        <h1>Список пользователей</h1>
    </div>
    <div class="form-group text-center">
        <a href="/dashboard/author/users/create" title="Создать нового пользователя" class="btn btn-primary">Создать нового пользователя</a>
    </div>
    <hr/>
    <table class="table table-striped table-hover ">
        <thead>
        <tr>
            <th>#</th>
            <th>Имя</th>
            <th>Email</th>
            <th>Тип</th>
            <th>&nbsp;</th>
        </tr>
        </thead>
        <tbody>
        @foreach($data['users'] as $user)
            <tr class="{{ ($user->id == Auth::user()->id) ? "info" : "" }}">
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->type->name }}</td>
                <td class="text-right">
                    <a href="/dashboard/author/users/{{ $user->id }}" title="{{ $user->name }}" class="btn btn-primary">Редактировать</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="text-center">
        {!! $data['users']->render() !!}
    </div>
@stop