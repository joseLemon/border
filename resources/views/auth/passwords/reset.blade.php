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
                        @if ($errors->has('password_confirmation'))
                            <div>{{ $errors->first('password_confirmation') }}</div>
                        @endif
                        <div>{{ \Session::get('alertMessage') }}</div>
                    </div>
                @endif
                <div class="box-header">Recuperar Contraseña</div>
                <div class="box-body">

                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form class="form-horizontal" method="POST" action="{{ route('password.request') }}">
                        {{ csrf_field() }}
                        <input type="hidden" name="token" value="{{ $token }}">
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="control-label">E-Mail Address</label>

                            <div class="">
                                <input id="email" type="email" class="form-control" name="email" value="{{ $email or old('email') }}" required autofocus>
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="control-label">Password</label>

                            <div class="">
                                <input id="password" type="password" class="form-control" name="password" required>
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label for="password-confirm" class="control-label">Confirm Password</label>
                            <div class="">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                Recuperar Contraseña
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
