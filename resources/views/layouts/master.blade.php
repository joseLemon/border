<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Border Opportunities</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    @yield('head')
    <script src="{{ asset('js/jquery/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('js/popper.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light fixed-top">

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-navbar" aria-controls="main-navbar" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="main-navbar">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="#">Why the border?</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Directory</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Contact</a>
            </li>
        </ul>
    </div>

</nav>
<div class="content-wrapper">
    @yield('content')
</div>
<footer>
    <div class="row no-margin">
        <div class="col-sm-4">

        </div>
        <div class="col-sm-4">

        </div>
        <div class="col-sm-4">

        </div>
    </div>
    <div class="footer-bottom text-center">
        <span>Derechos Reservados {{ date('Y') }}</span>
    </div>
</footer>
@yield('scripts')
</body>
</html>