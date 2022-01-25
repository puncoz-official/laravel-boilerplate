<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title inertia>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/tailwind.css', 'dist') }}">
    <link rel="stylesheet" href="{{ mix('css/app.css', 'dist') }}">

    <!-- Scripts -->
    @env ('local')
    @routes
    @endenv
    <script src="{{ mix('js/manifest.js', 'dist') }}" defer></script>
    <script src="{{ mix('js/vendor.js', 'dist') }}" defer></script>
    <script src="{{ mix('js/app.js', 'dist') }}" defer></script>
</head>
<body class="font-sans antialiased">
@inertia

@env ('local')
    @if(env('MIX_ENABLE_BROWSER_SYNC', false))
        <script src="http://localhost:3000/browser-sync/browser-sync-client.js"></script>
    @endif
@endenv
</body>
</html>
