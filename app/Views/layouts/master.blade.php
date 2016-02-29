<!DOCTYPE html>
<html>
<head>
    @include('includes.head')
</head>
<body>
    <div class="container">
        <div id="header">
            @include('includes.header')
        </div>
        <div id="menu">
            @include('includes.menu')
        </div>
        <div id="content">
            @yield('content')
        </div>
        <div id="footer">
            @include('includes.footer')
        </div>
    </div>
</body>
</html>