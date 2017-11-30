<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ env('APP_NAME') }}</title>
    <link rel="icon" href="{{ asset('public/favicon.ico') }}">
    <link rel="stylesheet" href="{{ asset('cms/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('cms/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('cms/js/jquery-confirm/css/jquery-confirm.css') }}">
    @yield('head')
    <script src="{{ asset('js/jquery/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('js/jquery-ui/easing/jquery-ui-easing.js') }}"></script>
    <script src="{{ asset('cms/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('cms/js/jquery-confirm/js/jquery-confirm.js') }}"></script>
    <script>
        $(document).ready(function () {
            // Add slideDown animation to Bootstrap dropdown when expanding.
            $('.dropdown').on('show.bs.dropdown', function() {
                $(this).find('.dropdown-menu').first().stop(true, true).slideDown('fast');
            });

            // Add slideUp animation to Bootstrap dropdown when collapsing.
            $('.dropdown').on('hide.bs.dropdown', function() {
                $(this).find('.dropdown-menu').first().stop(true, true).slideUp('fast');
            });

            $('.navbar-collapse').on('show.bs.collapse', function () {
                $('.main-menu').addClass('active');
            });

            $('.navbar-collapse').on('hide.bs.collapse', function () {
                $('.main-menu').removeClass('active');
            })
        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // GLOBAL FUNCTIONS
        function RemoveHTMLTags($text) {
            var regX = /(<([^>]+)>)/ig;
            return $text.replace(regX, "");
        }
    </script>
    @yield('scripts')
</head>
<body>
<div class="main-menu">
    <nav class="navbar navbar-default">

        <div class="navbar-header">
            <!--<a class="navbar-brand" href="#">Brand</a>-->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#nav-collapse" aria-expanded="false">
                <i class="fa fa-bars" aria-hidden="true"></i>
            </button>
        </div>

        <div class="collapse navbar-collapse" id="nav-collapse">
            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a href="{{route('cms.index') }}"><i class="fa fa-pencil-square menu-icon" aria-hidden="true"></i> Gestionar</a>
                    <!--<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-pencil-square menu-icon" aria-hidden="true"></i> Gestionar <i class="fa fa-chevron-right chevron" aria-hidden="true"></i></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{route('cms.index') }}">Gestionar sitio</a></li>
                        <li><a href="{{route('cms.index') }}">Gestionar hexágonos</a></li>
                    </ul>-->
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-users menu-icon" aria-hidden="true"></i> Usuarios <i class="fa fa-chevron-right chevron" aria-hidden="true"></i></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('register') }}">Nuevo</a></li>
                        <li><a href="{{ route('users.show') }}">Ver</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="{{ url('/').'/logout' }}"><i class="fa fa-sign-out menu-icon" aria-hidden="true"></i> Cerrar sesión</a>
                </li>
            </ul>
        </div>
    </nav>
</div>

<div class="content-wrapper">
    @if(\Session::has('alertMessage'))
        <div id="alertMessage" class="alert {{ Session::get('alert-class', 'alert-info') }}">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            {{ \Session::get('alertMessage') }}
        </div>
    @endif
    @if (!$errors->isEmpty())
        <div id="globalMessage" class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            @foreach ($errors->all() as $error)
                {{ $error }}<br>
            @endforeach
        </div>
    @endif
    @yield('content')
</div>

</body>
</html>