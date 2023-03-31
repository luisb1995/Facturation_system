@extends('layaout.auth')

@section('content')
<div class="align-items-center d-flex h-100" >
    <div class="card-body">

        <!-- Logo -->
        <div class="auth-brand text-center text-lg-left">

                <a href="{{ route('baterias-home') }}" class="logo-dark">
                    <span><img src="{{ asset('img/logo1.png') }}" alt="" height="120"></span>
                </a>
                <a href="{{ route('baterias-home') }}" class="logo-light">
                    <span><img src="{{ asset('img/logo1.png') }}" alt="" height="120"></span>
                </a>



        </div>

        <!-- title-->
        <h4 class="mt-0">@lang('auth2.login-title')</h4>
        <p class="text-muted mb-4">@lang('auth2.login-title-2')</p>

        <!-- form -->
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-group">
                <label for="emailaddress">@lang('auth2.usuario')</label>
                <input id="username" type="text" style="background-color:white;color:black;" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>
                @error('username')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">

                <label for="password">@lang('auth2.password')</label>
                    <input id="password" type="password" style="background-color:white;color:black;" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
            </div>

            <div class="form-group mb-0 text-center">
                    <button class="btn btn-primary btn-block" type="submit"><i class="mdi mdi-login"></i>
                        @lang('auth2.login')
                    </button>

            </div>

            <!-- social-->
            <div class="text-center mt-4">

            </div>
        </form>
        <!-- end form-->

        <!-- Footer-->
        <footer class="footer footer-alt">

        </footer>

    </div> <!-- end .card-body -->
</div> <!-- end .align-items-center.d-flex.h-100-->
@endsection
