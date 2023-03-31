@extends('layaout.auth')

@section('content')

<div class="align-items-center d-flex h-100">
    <div class="card-body">

        <!-- Logo -->
        <div class="auth-brand text-center text-lg-left">
            
                <a href="{{ route('baterias-home') }}" class="logo-dark">
                    <span><img src="{{ asset('img/logo1.png') }}" alt="" height="60"></span>
                </a>
                <a href="{{ route('baterias-home') }}" class="logo-light">
                    <span><img src="{{ asset('img/logo1.png') }}" alt="" height="60"></span>
                </a>
            
        </div>
<br><br>
        <!-- title-->
        <h4 class="mt-0">@lang("auth2.registrate")</h4>
        <p class="text-muted mb-4">¿Don't have a account? Sign up, take less than a minute</p>

        <!-- form -->
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="form-group">
                <label for="name">Nombre</label>
                <input id="name" type="text" class="form-control  @error('name') is-invalid @enderror" name="name" placeholder="Your alias" value="{{ old('name') }}" required autocomplete="name" autofocus>
                @error('name')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="username">Usuario</label>
                <input id="username" type="text" class="form-control  @error('username') is-invalid @enderror" name="username" placeholder="Your username" value="{{ old('username') }}" required autocomplete="username" autofocus>
                @error('username')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="email">Email de recuperacion</label>
                <input id="email" placeholder="Email for recovery data" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="password">Contraseña</label>
                <input id="password" placeholder="Enter your password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="password-confirm">Confirma tu contraseña</label>
                <input id="password-confirm" placeholder="Confirm your password" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
            </div>
            
            <div class="form-group mb-0 text-center">
                <button type="submit" class="btn btn-primary btn-block">
                    <i class="mdi mdi-account-circle"></i> @lang("auth2.registrate")
                </button>
            </div>
            
          
        </form>
        <!-- end form-->

        <!-- Footer-->
        <footer class="footer footer-alt">
            <p class="text-muted">¿Ya posees una cuenta? <a href="{{ route('login') }}" class="text-muted ml-1"><b>Ingresar</b></a></p>
        </footer>

    </div> <!-- end .card-body -->
</div> <!-- end .align-items-center.d-flex.h-100-->
@endsection
