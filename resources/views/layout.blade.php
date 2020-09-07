<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
    <link rel="stylesheet" href="{{ mix('/css/theme.css') }}">
    <title>Document</title>
</head>
<body>
    @if (session()->has('status'))
        <h3 style="color:green">
            {{ session()->get('status') }}
        </h3>
    @endif
    <nav class="navbar navbar-expand navbar-light bg-light">
        <ul class="nav navbar-nav">
            <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">HOME</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('about') }}">ABOUT</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('posts.create') }}">NEW POST</a></li>
        </ul>
    </nav>
    <div class="container">
        @yield('content')
    </div>
    

   <script src="{{ mix('/js/app.js') }}"></script>
</body>
</html> 