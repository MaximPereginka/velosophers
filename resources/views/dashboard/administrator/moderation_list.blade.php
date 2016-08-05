@extends('layouts.dashboard')

@section('content')
    <div class="page-header">
        <h1>Модерация статтей</h1>
    </div>
    <div class="col-md-12">
        <div class="row">
            @if(empty($data['articles']))
                <p>Не выставлено ни одной статьи для модерации</p>
            @else
                <table class="table table-striped table-hover ">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Название</th>
                        <th>Автор</th>
                        <th>&nbsp;</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($data['articles'] as $article)
                        <tr>
                            <td>{{ $article['id'] }}</td>
                            <td><a href="/dashboard/administrator/article/{{ $article['id'] }}/moderation" title="Модерация">{{ $article['title'] }}</a></td>
                            <td><a href="/dashboard/author/users/{{ $article->user->id }}" title="Страница пользователя">{{ $article->user->name }}</a></td>
                            <td class="text-right">
                                <a href="/dashboard/administrator/article/{{ $article['id'] }}/moderation" class="btn btn-primary" title="Модерация">Модерация</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
@stop