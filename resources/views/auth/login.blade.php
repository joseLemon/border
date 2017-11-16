@extends('layouts.cms.login')

@section('content')
    <div class="container">
        <div class="row">
            <div class="login-box">
                @if(count($errors) != 0 || \Session::has('alertMessage'))
                    <div class="box-errors alert alert-danger fade show alert-dismissible">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
                        @if ($errors->has('email'))
                            <div>{{ $errors->first('email') }}</div>
                        @endif
                        @if ($errors->has('password'))
                            <div>{{ $errors->first('password') }}</div>
                        @endif
                        <div>{{ \Session::get('alertMessage') }}</div>
                    </div>
                @endif
                <div class="box-header">Iniciar Sesión</div>
                <div class="box-body">
                    <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="control-label">Correo Electrónico</label>
                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" autofocus>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="control-label">Contraseña</label>
                            <input id="password" type="password" class="form-control" name="password">
                        </div>

                        <div class="form-group remember-me">
                            <div class="checkbox">
                                <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}><label class="check-box" for="remember"></label> Recuérdame
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                Iniciar Sesión
                            </button>
                        </div>
                    </form>
                </div>
                <div class="box-footer">
                    <a class="btn btn-link" href="{{ route('password.request') }}">
                        ¿Olvidaste tu contraseña?
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
