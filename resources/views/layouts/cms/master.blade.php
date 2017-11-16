<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SIDE</title>
    <link rel="icon" href="{{ asset('public/favicon.ico') }}">
    <link rel="stylesheet" href="{{ asset('public/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/cms/style.css') }}">
    <link rel="stylesheet" href="{{ asset('public/js/modules/jquery-confirm/css/jquery-confirm.css') }}">
    <link rel="stylesheet" href="{{ asset('public/js/modules/jquery-ui/datepicker/jquery-ui-datepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('public/js/modules/jquery-ui/selectmenu/jquery-ui-selectmenu.min.css') }}">
    @yield('head')
    <script src="{{ asset('public/js/jquery.min.js') }}"></script>
    <script src="{{ asset('public/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('public/js/modules/jquery-confirm/js/jquery-confirm.js') }}"></script>
    <script src="{{ asset('public/js/modules/jquery-ui/datepicker/jquery-ui-datepicker.js') }}"></script>
    <script src="{{ asset('public/js/modules/jquery-ui/selectmenu/jquery-ui-selectmenu.min.js') }}"></script>
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
            })

            $('.navbar-collapse').on('hide.bs.collapse', function () {
                $('.main-menu').removeClass('active');
            })
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
                @if(\Auth::user()->user_role_id < 3)
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-pencil menu-icon" aria-hidden="true"></i> Blog <i class="fa fa-chevron-right chevron" aria-hidden="true"></i></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ route('blog.create') }}">Nuevo</a></li>
                            <li><a href="{{ route('blog.show') }}">Ver</a></li>
                        </ul>
                    </li>
                @endif
                @if(\Auth::user()->user_role_id == 1)
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-file-o menu-icon" aria-hidden="true"></i> Páginas <i class="fa fa-chevron-right chevron" aria-hidden="true"></i></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ route('page.create') }}">Nuevo</a></li>
                            <li><a href="{{ route('pages.show') }}">Ver</a></li>
                        </ul>
                    </li>
                @endif
                @if(\Auth::user()->user_role_id == 1)
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-users menu-icon" aria-hidden="true"></i> Usuarios <i class="fa fa-chevron-right chevron" aria-hidden="true"></i></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ route('register') }}">Nuevo</a></li>
                            <li><a href="{{ route('users.show') }}">Ver</a></li>
                        </ul>
                    </li>
                @endif
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