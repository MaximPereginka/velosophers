@extends('layouts.dashboard')

@section('content')
    @include('helpers.dashboard.mutual.home.header')

    <div class="row">
        <div class="col-md-3">
            <div class="row">
                <div class="col-md-6">
                    <a href="/dashboard/moderator/moderation_list" title="Модерация статтей">Модерация статтей</a>
                </div>
            </div>
        </div>
        @include('helpers.dashboard.mutual.home.private_office')
    </div>
@stop