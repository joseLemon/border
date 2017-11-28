<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Border Opportunities</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    @yield('head')
    <script src="{{ asset('js/jquery/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('js/jquery-ui/easing/jquery-ui-easing.js') }}"></script>
    <script src="{{ asset('js/popper.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/functionality.js') }}"></script>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light fixed-top">

    <a class="navbar-brand" href="#"></a>

    <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#main-navbar" aria-controls="main-navbar" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="main-navbar">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link smoothscroll" href="#the-border">Why the border?</a>
            </li>
            <li class="nav-item">
                <a class="nav-link smoothscroll" href="#directory">Directory</a>
            </li>
            <li class="nav-item">
                <a class="nav-link smoothscroll" href="#contact">Contact</a>
            </li>
        </ul>
    </div>

</nav>
<div class="content-wrapper">
    @yield('content')
</div>
<!-- ================================== -->

<!-- ///////////  FOOTER  \\\\\\\\\\\ -->

<!-- ================================== -->
<footer class="div-section">
    <div class="container light-spacing">
        <div class="row cols-centered">
            <div class="col-sm-4">
                <p>{{ isset($cms) ? $cms->footer_address: '' }}</p>
            </div>
            <div class="col-sm-4">
                <img class="img-fluid" src="{{ asset('uploads/cms/footer_img'. strchr($cms->footer_img,'.')) }}" alt="Border Opportunities">
            </div>
            <div class="col-sm-4 text-center">
                <a href="{{ isset($cms) ? $cms->footer_fb : '#' }}"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                <a href="{{ isset($cms) ? $cms->footer_twitter : '#' }}"><i class="fa fa-twitter" aria-hidden="true"></i></a>
            </div>
        </div>
    </div>
    <div class="footer-bottom text-center">
        <span>{{ isset($cms) ? $cms->footer_bottom: '' }}</span>
    </div>
</footer>
@yield('scripts')
</body>
</html>