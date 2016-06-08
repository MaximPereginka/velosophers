@extends('layouts.administrator')

@section('content')

    <div class="page-header">
        <h1>Категории</h1>
    </div>
    <form class="form-inline" action="/administrator/blog/categories/create" method="post">
        <div class="form-group">
            <input type="text" class="form-control" name="title" id="title" placeholder="Название категории">
        </div>
        <div class="form-group">
            <select name="parent_id" class="form-control">
                <option value="0">Нет родителя</option>
                @foreach($data['categories'] as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Создать</button>
        </div>

        <input type="hidden" name="_token" value="{{ csrf_token() }}">
    </form>

    <hr/>

    <table class="table table-striped table-hover">
        <thead>
        <tr>
            <th>#</th>
            <th>Название категории</th>
            <th>Родитель</th>
            <th>&nbsp;</th>
        </tr>
        </thead>
        <tbody>
        @foreach($data['categories'] as $category)
        <tr>
            <td>{{ $category->id }}</td>
            <td>{{ $category->name }}</td>
            <td>
                @if(!$category->has_parent)
                    {{ "Нет родителя" }}
                @else
                    {{ $category->parent }}
                @endif
            </td>
            <td class="pull-right"><a class="btn btn-danger" href="/administrator/blog/categories/{{ $category->id }}/delete">Удалить</a></td>
        </tr>
        @endforeach
        </tbody>
    </table>

@stop
