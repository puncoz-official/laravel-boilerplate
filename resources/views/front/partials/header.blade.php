<div class="top-right links">
    @auth
        <a href="{{ url('/home') }}">Home</a>
    @else
        <a href="#">Login</a>
        
        <a href="#">Register</a>
    @endauth
</div>
