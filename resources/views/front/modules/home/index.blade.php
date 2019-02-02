@extends('front.layouts.app')

@section('content')
    <div class="title m-b-md">
        {{ config('app.name') }}
    </div>
    
    <div class="links">
        <a href="https://github.com/puncoz/laravel-scaffolding" target="_blank">GitHub</a>
        <a href="https://laravel.com/docs" target="_blank">Laravel Docs</a>
    </div>
@endsection
