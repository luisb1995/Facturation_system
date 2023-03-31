<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from coderthemes.com/hyper/saas/pages-login-2.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 08 Sep 2020 14:26:07 GMT -->
<head>
        <meta charset="utf-8" />
        <title>FS - Login</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Administrative software, Software administrativo" name="description" />
        <meta content="Skyrise Technology corporation" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ asset('img/fav2.png') }}">
        <!-- App css -->
        <link href="{{ asset('dashboardAssets/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('dashboardAssets/assets/css/app.min.css') }}" rel="stylesheet" type="text/css" id="light-style" />
        <link href="{{ asset('dashboardAssets/assets/css/app-dark.min.css') }}" rel="stylesheet" type="text/css" id="dark-style" />

    </head>

    <body class="authentication-bg pb-0" style="background-image:url({{ asset('dashboardAssets/assets/images/bg-pattern-light.svg') }}" data-layout-config='{"darkMode":true}' >

        <div class="auth-fluid">
            <!--Auth fluid left content -->
            <div class="auth-fluid-form-box" style="background-color:#1b44b9;">
               @yield('content')
            </div>

            <!-- end auth-fluid-form-box--->

            <!-- Auth fluid right content -->
            <div class="auth-fluid-right text-center">
                <div class="auth-user-testimonial">
                    <h2 class="mb-3">Administrativo.</h2>

                    <p>
                        - Impulsando a tu empresa!.
                    </p>
                </div> <!-- end auth-user-testimonial-->
            </div>
            <!-- end Auth fluid right content -->
        </div>
        <!-- end auth-fluid-->

        <!-- bundle -->
        <script src="{{ asset('dashboardAssets/assets/js/vendor.min.js') }}"></script>
        <script src="{{ asset('dashboardAssets/assets/js/app.min.js') }}"></script>

    </body>


<!-- Mirrored from coderthemes.com/hyper/saas/pages-login-2.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 08 Sep 2020 14:26:07 GMT -->
</html>
