<!doctype html>
<html>
<head>
    @include('includes.head')
</head>
<body>

    <header class="jumbotron">
        @include('includes.header')
    </header>


    @yield('content')

    <footer class="footer text-center">
        @include('includes.footer')
    </footer>
</body>
</html>    