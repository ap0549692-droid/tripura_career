<h1>Tripura Career</h1>
<div style="text-align:right; padding:20px;">
    @if(Auth::check())
        <span>Hi, {{ Auth::user()->name }}</span>
        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST">@csrf</form>
    @else
        <a href="{{ route('login') }}">Login</a> | 
        <a href="{{ route('register') }}">Register</a>
        <a href="/scholarships/create">
    <button style="background:green; color:white; padding:12px 20px; border:none; border-radius:5px;">
        Apply For Scholarship
    </button>
</a>
    @endif
</div>