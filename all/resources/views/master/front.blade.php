<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <title>Document</title>

</head>
<body>
<nav class="navbar navbar-expand-md navbar-light bg-info border-bottom shadow sticky-top ">
    <div class="container">
        <a href="{{asset('/')}}" class="navbar-brand">| MyApp |</a>
        <ul class="navbar-nav">
{{--            <li><a href="{{url('/login/admin')}}" class="nav-link">Login</a></li>--}}
{{--            <li><a href="{{url('/register')}}" class="nav-link"> User Register</a></li>--}}
            <li><a href="{{url('/register/admin')}}" class="nav-link">Admin Register</a></li>
            <li><a href="{{url('/register/merchant')}}" class="nav-link">Merchant Register</a></li>
        </ul>
    </div>
</nav>

@yield('content')

</body>
</html>
