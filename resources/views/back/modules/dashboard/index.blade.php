@extends('back.layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="card-header">Dashboard</div>
    
    <div class="card-body">
        Welcome {{ currentUser()->display_name }}! You are logged in.
    </div>
@endsection
