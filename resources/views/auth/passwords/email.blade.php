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
        <p class="text-muted mb-4">Ingresa tu email para restablecer la contraseña</p>
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
        <!-- form -->
        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="form-group ">
                <label for="email" class="col-md-12 col-form-label text-md-left">Dirección Email</label>

                <div class="col-md-12">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row mb-0">
                <div class="col-md-12 text-center">
                    <button type="submit" class="btn btn-primary">
                        <i class="mdi mdi-login"></i> Restablecer contraseña
                        
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
