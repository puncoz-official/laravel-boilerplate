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
	<link rel="stylesheet" href="{{ mix('css/app.css', 'auth') }}">
	@stack('css')
</head>
<body>

<main id="app">
	@include('auth.partials.nav-bar')
	
	<div class="content py-4">
		@yield('content')
	</div>
</main>

<!-- Scripts -->
<script src="{{ mix('js/app.js', 'auth') }}"></script>
@stack('scripts')

</body>
</html>
