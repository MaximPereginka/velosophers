@extends('layouts.administrator')

@section('content')
    <div class="page-header">
        <h1>Список пользователей</h1>
    </div>

    <table class="table table-striped table-hover">
        <thead>
        <tr>
            <th>#</th>
            <th>Логин</th>
            <th>Email</th>
            <th>Тип</th>
            <th>&nbsp;</th>
        </tr>
        </thead>
        <tbody>
        @foreach($data['users'] as $user)
            <tr @if($user->id == Auth::user()->id)
                class="success"
                    @endif
            >
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->type->name }}</td>
                <td class="text-right"><a class="btn btn-primary" href="/administrator/users/edit/{{ $user->id }}">Подробнее</a></td>
            </tr>
        @endforeach
    </table>
@stop