@extends('layouts.dashboard')

@section('content')
    <div class="page-header">
        <h1>{{ $data['article']->title }}</h1>
    </div>
    <div class="row">
        <div class="col-md-9">
            <div class="content">
                {!! $data['article']->content !!}
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                @if(in_array($data['article']->status_id, [1,4,5]))
                    <a href="/dashboard/author/articles/{{ $data['article']->id }}/moderation" title="Опубликовать" class="form-control btn btn-success">Опубликовать</a>
                @elseif($data['article']->status_id == 2)
                    <a href="/dashboard/author/articles/{{ $data['article']->id }}/unpublish" title="Снять с публикации" class="form-control btn btn-warning">Снять с публикации</a>

                @elseif($data['article']->status_id == 3)
                    <a href="/dashboard/author/articles/{{ $data['article']->id }}/cancel_moderation" title="Не публиковать" class="form-control btn btn-warning">Не публиковать</a>
                @endif
            </div>

            <div class="form-group">
                <a href="/dashboard/author/articles/{{ $data['article']->id }}/edit" title="Редактировать" class="form-control btn btn-primary">Редактировать</a>
            </div>

            <div class="form-group">
                <a href="/dashboard/author/articles/{{ $data['article']->id }}/delete" title="Удалить" class="form-control btn btn-danger">Удалить</a>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">Подробности</div>
                <div class="panel-body">
                    <img class="thumbnail" style="width: 100%" alt="Изображение статьи" src="{{ ($data['article']->img) ? $data['article']->img : "/img/dashboard/no-image.png" }}" />

                    <p><b>Дата создания: </b>{{ $data['article']->created_at->format('d.m.o.') }}</p>
                    @if($data['article']->status_id == 2)
                        <p><b>Дата публикации: </b>{{ $data['article']->published_at->format('d.m.o.') }}</p>
                    @endif
                    <p><b>Статус: </b>{{ $data['article']->status->name }}</p>
                    @if(!$data['article']->categories->isEmpty())
                        <b>Категории: </b>
                        @foreach($data['article']->categories as $category)
                            <a href="/dashboard/author/articles/category/{{ $category->id }}" class="label label-success">{{ $category->name }}</a>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
@stop