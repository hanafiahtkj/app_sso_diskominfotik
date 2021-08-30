@php
$user = auth()->user();
@endphp

<div class="navbar-bg bg-transparent"></div>
<nav class="navbar navbar-expand-lg main-navbar">
<div class="container">
    <!-- <a href="{{ url('') }}" class="navbar-brand d-none d-md-none"><img src="{{ asset('img/logo.png') }}" width="225" height="51" class="d-inline-block align-top" alt=""></a> -->
    <a class="navbar-brand d-none d-lg-block" href="{{ url('') }}"><img src="{{ asset('img/logo.png') }}" width="225" height="51" class="d-inline-block align-top" alt=""></a>
    <div class="navbar-nav">
        <a href="#" class="nav-link sidebar-gone-show" data-toggle="sidebar"><i class="fas fa-bars"></i></a>
    </div>
    <a href="{{ url('') }}" class="navbar-brand sidebar-gone-show nav-collapse-toggle nav-link"><img src="{{ asset('img/logo.png') }}" width="225" height="51" class="d-inline-block align-top" alt=""></a>
    
    <ul class="navbar-nav navbar-right">
        
        <li class="dropdown"><a href="#" data-turbolinks="false" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
            @if (!is_null($user))
                <img alt="image" src="{{ $user->profile_photo_url }}" class="rounded-circle mr-1" style="display: inline!important;">
                <div class="d-sm-none d-lg-inline-block">Hi, {{ $user->name }}</div></a>
            @else
                <img alt="image" src="{{ asset('img/avatar/avatar-1.png') }}" class="rounded-circle mr-1" style="display: inline!important;">
                <div class="d-sm-none d-lg-inline-block">Hi, Selamat datang</div></a>
            @endif
            <div class="dropdown-menu dropdown-menu-right">
                @auth
                <a href="/user/profile" class="dropdown-item has-icon">
                    <i class="far fa-user"></i> Profil
                </a>
                <div class="dropdown-divider"></div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <a href="{{ route('logout') }}" class="dropdown-item has-icon text-danger" onclick="event.preventDefault();this.closest('form').submit();">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>
                </form>
                @else
                <a href="/login" class="dropdown-item has-icon">
                    Login
                </a>
                <a href="/register" class="dropdown-item has-icon">
                    Register
                </a>
                @endauth
            </div>
        </li>
        
    </ul>
</div>
</nav>
