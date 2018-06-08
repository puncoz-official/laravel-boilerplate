@extends('front.layouts.main')

@section('title', __('Home'))

@section('content')
	<div class="title m-b-md">{{ config('app.name') }}</div>
	
	<div class="links">
		<a href="#">{{ __('System Logs') }}</a>
		<a href="#">{{ __('ApiLogs') }}</a>
		<a href="#">{{ __('ApiDocs') }}</a>
	</div>
@endsection
