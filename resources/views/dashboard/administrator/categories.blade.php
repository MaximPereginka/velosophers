@extends('layouts.dashboard')

@section('content')
    <div class="page-header">
        <h1>Список категорий</h1>
    </div>
    <form class="form-inline" action="/dashboard/administrator/articles/categories/create" method="post">
        {{ csrf_field() }}
        <div class="form-group">
            <input type="text" class="form-control" id="catname" name="catname" value="{{ old('catname') }}" placeholder="Название категории">
        </div>
        <div class="form-group">
            <select class="form-control" id="parent_id" name="parent_id">
                <option value="0">Нет родителя</option>
                @foreach($data['categories'] as $category)
                    <option value="{{ $category['id'] }}"
                    @if(old('parent_id') && (old('parent_id') == $category['id']))
                        selected
                    @endif
                    >
                    {{ $category['name'] }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <button class="btn form-control btn-success" type="submit">Создать категорию</button>
        </div>
    </form>
    <hr/>
    @if(empty($data['categories']))
        <p>Не создано ни одной категории</p>
    @else
        <table class="table table-striped table-hover ">
            <thead>
            <tr>
                <th>#</th>
                <th>Название</th>
                <th>&nbsp;</th>
            </tr>
            </thead>
            <tbody>
            @foreach($data['categories'] as $category)
                <tr>
                    <td>{{ $category['id'] }}</td>
                    <td style="padding-left: {{ $category['nesting']*2 }}8px">@if($category['nesting'])&rarr; @endif{{ $category['name'] }}</td>
                    <td class="text-right">
                        <a href="/dashboard/administrator/articles/categories/{{ $category['id'] }}/delete" title="Удалить категорию {{ $category['name'] }}" class="btn btn-danger">Удалить</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif
@stop