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
        <h4 class="mt-0">Confirmar contraseña</h4>
        <p class="text-muted mb-4">Porfavor confirme la contraseña para continuar</p>

        <!-- form -->
        <form method="POST" action="{{ route('password.confirm') }}">
            @csrf

            <div class="form-group">
                <label for="password" class="col-12 col-form-label text-left">Contraseña</label>

                <div class="col-12">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group mb-0">
                <div class="col-12 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                        <i class="mdi mdi-login"></i> Confirmar contraseña
                    </button>

                    @if (Route::has('password.request'))
                        <a class="btn btn-link" href="{{ route('password.request') }}">
                            Olvidaste tu contraseña?
                        </a>
                    @endif
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
