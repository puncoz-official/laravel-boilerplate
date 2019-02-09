<!doctype html>
<html lang="{{ getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="app-name" content="{{ config('app.name') }}">
    
    <title>
        @hasSection('title')
            @yield('title') |
        @endif
        {{ config('app.name') }}
    </title>
    
    {{--CSRF Token--}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    {{--Fonts--}}
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
    
    {{--Styles--}}
    <link href="{{ front_mix('css/app.css') }}" rel="stylesheet">
    @stack('css')
</head>
<body>

<main id="app">
    <div class="flex-center position-ref full-height">
        @include('front.partials.header')
        
        <div class="content">
            @yield('content')
        </div>
    </div>
</main>

{{--Scripts--}}
<script src="{{ front_mix('js/manifest.js') }}"></script>
<script src="{{ front_mix('js/vendor.js') }}"></script>
<script src="{{ front_mix('js/app.js') }}"></script>
@stack('js')

</body>
</html>
