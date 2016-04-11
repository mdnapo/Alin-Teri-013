<?php
$items = App\Page::where('active', 1)->where('route', '!=', '')->get();
?>
<nav class="navbar navbar-default navbar-fixed-top shadow-z-1">
    <div class="container-fluid">
        <div class="navbar-header">
            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target=".navbar-responsive-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- Branding Image -->
            <a class="navbar-brand collapsed" href="{{ url('/') }}">
                <span>AlinTeri</span>
            </a>
        </div>

        <div class="navbar-collapse collapse navbar-responsive-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav">
                <li class="link"><a href="{{ url('/') }}">Home</a></li>
                <li class="link"><a href="{{ url('/steun-ons') }}">Steun ons</a></li>
                <li class="link"><a href="{{ url('/contact') }}">Contact</a></li>
                @foreach($items as $item)
                    <li class="link">
                        <a href="{{ url('/p/'.$item->route) }}">{{ $item->name }}</a>
                    </li>
                @endforeach
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->
                @if (Auth::guest())
                    <li class="link"><a href="{{ url('/login') }}">Login</a></li>
                    <li class="link"><a href="{{ url('/register') }}">Register</a></li>
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            Welkom {{ Auth::user()->name }} <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            @if(App\User::isAdmin(Auth::user()->id))
                                <li><a href="{{ url('/admin/dashboard') }}"><i class="fa fa-btn">DashBoard</i></a></li>
                            @endif
                            <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>