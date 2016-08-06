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

            <hr/>

            <!-- Article comments -->
            @include('helpers.dashboard.administrator.comments')
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <a href="/dashboard/administrator/article/{{ $data['article']->id }}/publish" class="form-control btn btn-success" title="Опубликовать">Опубликовать</a>
            </div>
            <div class="form-group">
                <a onclick="show_modal('reject_article')" href="#" class="form-control btn btn-danger" title="Отклонить">Отклонить</a>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">Подробности</div>
                <div class="panel-body">
                    <img class="thumbnail" style="width: 100%" alt="Изображение статьи" src="{{ ($data['article']->img) ? $data['article']->img : "/img/dashboard/no-image.png" }}" />

                    <p><b>Автор:</b> {{ (is_null($data['article']->user)) ? "Velosophers" : $data['article']->user->name}}</p>
                    <p><b>Дата создания: </b>{{ $data['article']->created_at->format('d.m.o.') }}</p>

                    @if(!$data['article']->categories->isEmpty())
                        <b>Категории: </b>
                        @foreach($data['article']->categories as $category)
                            <span class="label label-success">{{ $category->name }}</span>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Modal window -->
    <div id="reject_article" class="modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="/dashboard/administrator/article/{{ $data['article']->id }}/reject" method="post">
                    {{ csrf_field() }}
                    {{ method_field("PATCH") }}
                    <div class="modal-header">
                        <button type="button" onclick="hide_modal('reject_article')" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Отклонение публикации</h4>
                    </div>
                    <div class="modal-body">


                        <div class="form-group">
                            <label class="control-label" for="reason">Причина</label>
                            <textarea rows="3" class="form-control" id="reason" name="reason" placeholder="Введите причину оклонения публикации...">{{ old('reason') }}</textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button onclick="hide_modal('reject_article')" type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                        <button type="submit" class="btn btn-danger">Отклонить</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop