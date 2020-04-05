<div class="top-right links">
    @auth
        <a href="{{ route('back.dashboard') }}">Dashboard</a>
    @else
        <a href="{{ route('auth.login') }}">Login</a>

        <a href="{{ route('auth.register') }}">Register</a>
    @endauth
</div>
