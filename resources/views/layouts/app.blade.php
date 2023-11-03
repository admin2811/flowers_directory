<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title','Default Title')</title>
    <link rel="stylesheet" href="{{asset('bootstrap-5.3.0-dist/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{ asset('fontawesome-free-6.4.0-web/css/all.min.css') }}">
</head>
<body>
    <header>
      
    </header>
    <main>
        @yield('content')
    </main>
    <footer>
        <!--Footer content-->
    </footer>
    <script src = "{{asset('bootstrap-5.3.0-dist/js/bootstrap.min.js')}}"></script>
</body>
</html>