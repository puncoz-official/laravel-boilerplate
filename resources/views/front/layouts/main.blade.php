<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	
	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">
	
	<title>@yield('title', config('app.name'))</title>
	
	<!-- Styles -->
	<link rel="stylesheet" href="{{ mix('css/front/app.css') }}">
	@stack('css')
</head>
<body>

<main id="app" class="flex-center position-ref full-height">
	@include('front.partials.nav-bar')
	
	<div class="content">
		@yield('content')
	</div>
</main>

<!-- Scripts -->
<script src="{{ mix('js/front/app.js') }}"></script>
@stack('scripts')

</body>
</html>
