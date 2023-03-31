<!DOCTYPE html>
<html lang="en">


<head>
        <meta charset="utf-8" />
        <title>Panel Administrativo</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />

        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ asset('img/fav2.png') }}">
        <!-- third party css -->
        <link href="{{ asset('dashboardAssets/assets/css/vendor/dataTables.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('dashboardAssets/assets/css/vendor/responsive.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('dashboardAssets/assets/css/vendor/buttons.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('dashboardAssets/assets/css/vendor/select.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
        <!-- third party css end -->
        <!-- App css -->
        <link href="{{ asset('dashboardAssets/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('dashboardAssets/assets/css/app.min.css') }}" rel="stylesheet" type="text/css" id="light-style" />
        <link href="{{ asset('dashboardAssets/assets/css/app-dark.min.css') }}" rel="stylesheet" type="text/css" id="dark-style" />
        <link rel="stylesheet" href="{{ asset('dashboardAssets/assets/css/dropzone.min.css') }}">
        <link rel="stylesheet" href="{{ asset('dashboardAssets/assets/css/toastr.min.css') }}">
        <link href="{{ asset('dashboardAssets/assets/css/summernote-bs4.min.css') }}" rel="stylesheet">
       <style>
           [ x-cloak ] {
                display : none;
           }
       </style>

        @livewireStyles
        @livewireScripts
    </head>

    <body class="loading" data-layout-config='{"leftSideBarTheme":"dark","layoutBoxed":false, "leftSidebarCondensed":false, "leftSidebarScrollable":false,"darkMode":false, "showRightSidebarOnStart": true}'>
        <!-- Begin page -->
        <div class="wrapper">
            <!-- ========== Left Sidebar Start ========== -->
            <div class="left-side-menu" style="background-color:#1b44b9">

                <!-- LOGO -->

                    <a href="{{ route('baterias-home') }}" class="logo text-center logo-light" style="background-color:#1b44b9">
                        <span class="logo-lg" style="background-color:#1b44b9">
                            <img src="{{ asset('img/logo2.png') }}" alt="" class="img" height="70">
                        </span>
                        <span class="logo-sm" style="background-color:#1b44b9">
                            <img src="{{ asset('img/logosm2.png') }}" alt="" height="40">
                        </span>
                    </a>


                <div class="h-100" id="left-side-menu-container" data-simplebar >

                   <!--Sidebar-->
                   @include('layaout.components.dashboard.menu')
                   <!--Sidebar end-->


                    <!-- End Sidebar -->

                    <div class="clearfix"></div>

                </div>
                <!-- Sidebar -left -->

            </div>
            <!-- Left Sidebar End -->

            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->

            <div class="content-page" style="background-color:lightgray;">
                <div class="content" style="background-color:lightgray;">
                    <!-- Topbar Start -->
                    <div class="navbar-custom" style="background-color:#1b44b9">
                        <ul class="list-unstyled topbar-right-menu float-right mb-0">









                            <li class="dropdown notification-list" >
                                <a class="nav-link dropdown-toggle nav-user arrow-none mr-0" data-toggle="dropdown" href="#" role="button" aria-haspopup="false"
                                    aria-expanded="false" style="background-color:#1b44b9;border-color:#111827;">
                                    <span class="account-user-avatar">
                                        <img src="{{ asset('storage/imgUpload/'.auth()->user()->image->url) }}" alt="user-image" class="rounded-circle">
                                    </span>
                                    <span>
                                        <span class="account-user-name">{{ auth()->user()->name }}</span>
                                        <span class="account-position">
                                            @foreach (auth()->user()->getRoleNames() as $role)
                                            {{ $role }}
                                            @endforeach

                                        </span>
                                    </span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated topbar-dropdown-menu profile-dropdown">
                                    <!-- item-->
                                    <div class=" dropdown-header noti-title">
                                        <h6 class="text-overflow m-0">Welcome!</h6>
                                    </div>

                                    <!-- item-->


                                                                        <!-- item-->
                                    <a href="{{ route('logout') }}" class="dropdown-item notify-item"
                                        onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">

                                        <i class="mdi mdi-logout mr-1"></i>
                                        <span>Cerrar sesión</span>

                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>


                        </ul>
                        <button class="button-menu-mobile open-left disable-btn">
                            <i class="mdi mdi-menu"></i>
                        </button>

                    </div>
                    <!-- end Topbar -->

                    <!-- Start Content-->


                        <!-- start page title -->


                            @yield('content')


                        <!-- end page title -->

                     <!-- container -->

                </div> <!-- content -->

                <!-- Footer Start -->
                <footer class="footer d-none d-sm-block">
                    <div class="container-fluid">

                        <div class="row">
                            <div class="col-md-6">


                            </div>
                            <div class="col-md-6">
                                <div class="text-md-right footer-links d-none d-md-block">

                                </div>
                            </div>
                        </div>
                    </div>
                </footer>
                <!-- end Footer -->

            </div>

            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->


        </div>
        <!-- END wrapper -->



        <!-- bundle -->
        <script src="{{ asset('dashboardAssets/assets/js/vendor.min.js') }}"></script>

        <script src="{{ asset('dashboardAssets/assets/js/app.min.js') }}"></script>

         <!-- third party js -->
         <script src="{{ asset('dashboardAssets/assets/js/dropzone.min.js') }}"></script>

        <script src="{{ asset('dashboardAssets/assets/js/vendor/jquery.dataTables.min.js') }}"></script>

        <script src="{{ asset('dashboardAssets/assets/js/vendor/dataTables.bootstrap4.js') }}"></script>

        <script src="{{ asset('dashboardAssets/assets/js/vendor/dataTables.responsive.min.js') }}"></script>

        <script src="{{ asset('dashboardAssets/assets/js/vendor/responsive.bootstrap4.min.js') }}"></script>

        <script src="{{ asset('dashboardAssets/assets/js/vendor/dataTables.buttons.min.js') }}"></script>

        <script src="{{ asset('dashboardAssets/assets/js/vendor/buttons.bootstrap4.min.js') }}"></script>

        <script src="{{ asset('dashboardAssets/assets/js/vendor/buttons.html5.min.js') }}"></script>

        <script src="{{ asset('dashboardAssets/assets/js/vendor/buttons.flash.min.js') }}"></script>

        <script src="{{ asset('dashboardAssets/assets/js/vendor/buttons.print.min.js') }}"></script>

        <script src="{{ asset('dashboardAssets/assets/js/vendor/dataTables.keyTable.min.js') }}"></script>

        <script src="{{ asset('dashboardAssets/assets/js/vendor/dataTables.select.min.js') }}"></script>

        <script src="{{ asset('dashboardAssets/assets/js/summernote-bs4.min.js') }}"></script>

         <!-- third party js ends -->
        <script src="{{ asset('dashboardAssets/assets/js/pages/demo.datatable-init.js') }}"></script>


        <script src="{{ asset('dashboardAssets/assets/js/toastr.min.js') }}"></script>

        <script>
            //alert general
            window.livewire.on('alert', param => {
                toastr[param['type']](param['message']);
                $(param['modal']).modal('hide');
            });
            window.livewire.on('alertProfile', param => {
                toastr[param['type']](param['message']);
                $("#profileModal").modal('hide');
            });

            window.livewire.on('showModal', param => {

                $(param['modal']).modal('show');
            });

            window.livewire.on('changeFocus', param => {

                $(param['input']).focus();
            });
            window.livewire.on('testing', param => {

                window.open(param['url'],'_blank','popup','toolbar=0, menubar=0, height=200, width=200');
            });




       </script>



    </body>
</html>
