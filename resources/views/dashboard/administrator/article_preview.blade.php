@extends('layouts.dashboard')

@section('content')
    @include('helpers.dashboard.author.reject_message')

    <div class="page-header">
        <h1>{{ $data['article']->title }}</h1>
    </div>
    <div class="row">
        <div class="col-md-9">
            <div class="content">
                {!! $data['article']->content !!}
            </div>

            <hr/>

            <!-- Article comments -->
            @include('helpers.dashboard.administrator.comments')

        </div>

        <div class="col-md-3">
            <div class="form-group">
                <a href="/dashboard/administrator/articles/{{ $data['article']->id }}/edit" title="Редактировать" class="form-control btn btn-primary">Редактировать</a>
            </div>

            <div class="form-group">
                <a onclick="show_modal('delete_article')" href="#" title="Удалить" class="form-control btn btn-danger">Удалить</a>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">Подробности</div>
                <div class="panel-body">
                    <img class="thumbnail" style="width: 100%" alt="Изображение статьи" src="{{ ($data['article']->img) ? $data['article']->img : "/img/dashboard/no-image.png" }}" />

                    <p><b>Автор:</b> {{ (is_null($data['article']->user)) ? "Velosophers" : $data['article']->user->name }}</p>
                    @if($data['article']->status_id == 2)
                        <p><b>Дата публикации: </b>{{ $data['article']->created_at->format('d.m.o.') }}</p>
                    @else
                        <p><b>Дата создания: </b>{{ $data['article']->created_at->format('d.m.o.') }}</p>
                    @endif

                    <p><b>Статус: </b>{{ $data['article']->status->name }}</p>

                    @if(!$data['article']->categories->isEmpty())
                        <b>Категории: </b>
                        @foreach($data['article']->categories as $category)
                            <a href="/dashboard/administrator/articles/category/{{ $category->id }}" class="label label-success">{{ $category->name }}</a>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Modal window -->
    @include('helpers.dashboard.author.delete_article')
@stop