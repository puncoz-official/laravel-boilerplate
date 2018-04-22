@extends('front.layouts.main')

@section('title', 'Home')

@section('content')
	<div class="title m-b-md">{{ config('app.name') }}</div>
	
	<div class="links">
		<a href="#">System Logs</a>
		<a href="#">ApiLogs</a>
		<a href="#">ApiDocs</a>
	</div>
@endsection
