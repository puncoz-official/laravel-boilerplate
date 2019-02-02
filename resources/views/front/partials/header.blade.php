<div class="top-right links">
    @auth
        <a href="{{ route('front.home') }}">Home</a>
    @else
        <a href="{{ route('auth.login') }}">Login</a>
        
        <a href="{{ route('auth.register') }}">Register</a>
    @endauth
</div>
