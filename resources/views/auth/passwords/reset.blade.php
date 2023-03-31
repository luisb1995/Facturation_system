@extends('layaout.auth')

@section('content')
<div class="align-items-center d-flex h-100">
    <div class="card-body">

        <!-- Logo -->
        <div class="auth-brand text-center text-lg-left">
            
                <a href="{{ route('baterias-home') }}" class="logo-dark">
                    <span><img src="{{ asset('img/logo1.jpg') }}" alt="" height="60"></span>
                </a>
                <a href="{{ route('baterias-home') }}" class="logo-light">
                    <span><img src="{{ asset('img/logo1.jpg') }}" alt="" height="60"></span>
                </a>
           

            
        </div>

        <!-- title-->
        <h4 class="mt-0">Restablecer contraseña</h4>
<!--        <p class="text-muted mb-4">{{ __('Please confirm your password before continuing.') }}</p>-->

        <!-- form -->
        <form method="POST" action="{{ route('password.update') }}">
            @csrf

            <input type="hidden" name="token" value="{{ $token }}">

            <div class="form-group">
                <label for="email" class="col-12 col-form-label text-left">Dirección Email</label>

                <div class="col-12">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="password" class="col-12 col-form-label text-left">Nueva contraseña</label>

                <div class="col-12">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="password-confirm" class="col-12 col-form-label text-left">Confirme la contraseña</label>

                <div class="col-12">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                </div>
            </div>

            <div class="form-group  mb-0">
                <div class="col-12 text-center">
                    <button type="submit" class="btn btn-primary">
                        <i class="mdi mdi-login"></i> Cambiar contraseña
                    </button>
                </div>
            </div>
        </form>
        <!-- end form-->

        <!-- Footer-->
        <footer class="footer footer-alt">
            <p class="text-muted">@lang('auth2.cuenta') <a href="{{ route('register') }}" class="text-muted ml-1"><b>@lang('auth2.registrate')</b></a></p>
        </footer>

    </div> <!-- end .card-body -->
</div> <!-- end .align-items-center.d-flex.h-100-->
@endsection
