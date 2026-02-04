<!doctype html>
<html lang="en" dir="ltr">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>

    <!-- META DATA -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Noa - Laravel Bootstrap 5 Admin & Dashboard Template">
    <meta name="author" content="Spruko Technologies Private Limited">
    <meta name="keywords"
        content="laravel admin template, bootstrap admin template, admin dashboard template, admin dashboard, admin template, admin, bootstrap 5, laravel admin, laravel admin dashboard template, laravel ui template, laravel admin panel, admin panel, laravel admin dashboard, laravel template, admin ui dashboard">

    <!-- TITLE -->
  <title>{{ $systemSettings?->site_name ?? 'Lifeizz' }} - @yield('title')</title>

    <!-- Favicon -->
    <link rel="shortcut icon"
        href="{{ asset($systemSettings?->system_favicon ?? 'uploads/systems/favicon/default-favicon.png') }}"
        type="image/x-icon">

    <!-- BOOTSTRAP CSS -->
    <link id="style" href="{{ asset('/') }}admin/assets/plugins/bootstrap/css/bootstrap.min.css"
        rel="stylesheet" />

    <!-- STYLE CSS -->
    <link href="{{ asset('/') }}admin/assets/css/style.css" rel="stylesheet" />
    <link href="{{ asset('/') }}admin/assets/css/skin-modes.css" rel="stylesheet" />



    <!--- FONT-ICONS CSS -->
    <link href="{{ asset('/') }}admin/assets/plugins/icons/icons.css" rel="stylesheet" />

    <!-- INTERNAL Switcher css -->
    <link href="{{ asset('/') }}admin/assets/switcher/css/switcher.css" rel="stylesheet">
    <link href="{{ asset('/') }}admin/assets/switcher/demo.css" rel="stylesheet">

     <style>
        .login100-form-btn {
            background-color: #a855f7;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 6px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .login100-form-btn:hover {
            background-color: #9333ea;
        }

        .create-account-link {
            color: #a855f7;
            font-weight: 600;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .create-account-link:hover {
            color: #9333ea;
            text-decoration: underline;
        }
    </style>

</head>


<body>



    <!-- GLOBAL-LOADER -->
    <div id="global-loader">
        <img src="{{ asset('/') }}admin/assets/images/loader.svg" class="loader-img" alt="Loader">
    </div>





    <!-- PAGE -->
    <div class="page">
        <div>
            <!-- CONTAINER OPEN -->

            <div class="container-login100">
                <div class="wrap-login100 p-0">
                    <div class="card-body">

                        <form class="login100-form validate-form" method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="col col-login mx-auto text-center">
                                <a class="header-brand1" href="{{ route('dashboard') }}">
                                    <img src="{{ asset($systemSettings->system_logo ?? 'uploads/systems/logo/default-logo.png') }}"
                                        class="header-brand-img rounded-circle" alt="logo" style="height: 80px; width: 80px; object-fit: cover;">
                                </a>
                            </div>
                            <div class="wrap-input100 validate-input" id="name">
                                <input class="input100" id="name" type="text" placeholder="Name" type="text"
                                    name="name" :value="old('name')" required autofocus autocomplete="name">
                                <span for="name" class="focus-input100"></span>
                                <span class="symbol-input100">
                                    <i class="mdi mdi-account" aria-hidden="true"></i>
                                </span>
                            </div>
                            <div class="wrap-input100 validate-input">
                                <input id="email" placeholder="User Email" class="input100" type="email"
                                    name="email" :value="old('email')" required autocomplete="username">
                                <span class="focus-input100"></span>
                                <span class="symbol-input100">
                                    <i class="zmdi zmdi-email" aria-hidden="true"></i>
                                </span>
                            </div>

                            <div class="wrap-input100 validate-input" data-bs-validate = "Password is required">
                                <input id="password" placeholder="Password" class="input100" type="password"
                                    name="password" required autocomplete="new-password">
                                <span class="focus-input100"></span>
                                <span class="symbol-input100">
                                    <i class="zmdi zmdi-lock" aria-hidden="true"></i>
                                </span>
                            </div>

                            <div class="wrap-input100 validate-input" data-bs-validate = "Password is required">
                                <input id="passwordConfirmation" placeholder="Confirm Password" class="input100"
                                    type="password" name="password_confirmation" required autocomplete="new-password">
                                <span class="focus-input100"></span>
                                <span class="symbol-input100">
                                    <i class="zmdi zmdi-lock" aria-hidden="true"></i>
                                </span>
                            </div>

                            

                            <div class="container-login100-form-btn">
                                <button type="submit" class="login100-form-btn">
                                    {{ __('Register') }}
                                </button>
                            </div>

                            
                            <div class="text-center pt-3">
                                <a href="{{ route('login') }}" class="create-account-link">
                                    Sign In
                                </a>
                            </div>

                        </form>
                    </div>
                    
                </div>
            </div>
            <!-- CONTAINER CLOSED -->
        </div>
    </div>
    <!-- END PAGE -->


    <!-- JQUERY JS -->
    <script src="{{ asset('/') }}admin/assets/plugins/jquery/jquery.min.js"></script>

    <!-- BOOTSTRAP JS -->
    <script src="{{ asset('/') }}admin/assets/plugins/bootstrap/js/popper.min.js"></script>
    <script src="{{ asset('/') }}admin/assets/plugins/bootstrap/js/bootstrap.min.js"></script>

    <!-- Perfect SCROLLBAR JS-->
    <script src="{{ asset('/') }}admin/assets/plugins/p-scroll/perfect-scrollbar.js"></script>

    <!-- STICKY JS -->
    <script src="{{ asset('/') }}admin/assets/js/sticky.js"></script>



    <!-- COLOR THEME JS -->
    <script src="{{ asset('/') }}admin/assets/js/themeColors.js"></script>

    <!-- CUSTOM JS -->
    <script src="{{ asset('/') }}admin/assets/js/custom.js"></script>

    <!-- SWITCHER JS -->
    <script src="{{ asset('/') }}admin/assets/switcher/js/switcher.js"></script>

</body>

</html>
