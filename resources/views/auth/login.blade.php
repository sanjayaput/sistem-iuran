<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login - {{ config('app.name', 'Laravel') }}
    </title>
    <!-- Global stylesheets -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet"
        type="text/css">
    <link href="{{ asset('assets/global/css/icons/icomoon/styles.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/bootstrap_limitless.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/layout.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/components.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/colors.min.css') }}" rel="stylesheet" type="text/css">
    <!-- /global stylesheets -->
    <!-- Core JS files -->
    <script src="{{ asset('assets/global/js/main/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/global/js/main/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/global/js/plugins/loaders/blockui.min.js') }}"></script>
    <!-- /core JS files -->
    <!-- Theme JS files -->
    <script src="{{ asset('assets/global/js/plugins/forms/styling/uniform.min.js') }}"></script>
    <script src="{{ asset('assets/global/js/plugins/forms/validation/validate.min.js') }}"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script>
    <script src="{{ asset('assets/global/js/init/login.js') }}"></script>
</head>

<body class="bg-white">
    <!-- Page content -->
    <div class="page-content">
        <!-- Main content -->
        <div class="content-wrapper">
            <!-- Content area -->
            <div class="content d-flex justify-content-center">
                <!-- Login card -->
                <div class="col-9">
                    <div class="card">
                        <div class="card-body text-center">
                            <img src="{{ asset('logo_asak.png') }}" width="200" height="200" class="rounded-circle"
                                alt="" />

                            <h4 class="font-weight-semibold mb-1">SELAMAT DATANG</h4>
                            <h5 class="card-title mb-4">DI SISTEM INFORMASI PENGELOLAAN KEUANGAN DESA ADAT ASAK</h5>
                            @if (getProfilDesa())
                                <h1>Profil Desa</h1>
                                {!! getProfilDesa()->konten !!}
                            @endif
                        </div>
                    </div>
                </div>
                <form class="form-login col-md-3 form-validate" method="POST" action="{{ route('login') }}">
                    {{ csrf_field() }}
                    <div class="card mb-0 ">
                        <div class="card-body">
                            <div class="text-center mb-3">
                                <h5 class="mb-0">Login
                                </h5>
                                <span class="d-block text-muted">{{ config('') }}SISTEM INFORMASI PENGELOLAAN
                                    KEUANGAN <br>DESA ADAT ASAK
                                </span>
                                @if (session('error'))
                                    <div class="alert mt-2 alert-danger alert-dismissible">
                                        <button type="button" class="close"
                                            data-dismiss="alert"><span>×</span></button>
                                        {{ session('error') }}
                                    </div>
                                @endif
                            </div>
                            <div
                                class="form-group form-group-feedback form-group-feedback-left{{ $errors->has('username') ? ' has-error' : '' }}">
                                <input id="username" type="username" class="form-control" placeholder="Username"
                                    name="username" value="{{ old('username') }}" required autofocus>
                                @if ($errors->has('username'))
                                    <span class="text-danger">
                                        {{ $errors->first('username') }}
                                    </span>
                                @endif
                                <div class="form-control-feedback">
                                    <i class="icon-user text-muted">
                                    </i>
                                </div>
                            </div>
                            <div
                                class="form-group form-group-feedback form-group-feedback-left{{ $errors->has('password') ? ' has-error' : '' }}">
                                <input id="password" type="password" placeholder="Sandi" class="form-control"
                                    name="password" required>
                                @if ($errors->has('password'))
                                    <span class="text-danger">
                                        {{ $errors->first('password') }}
                                    </span>
                                @endif
                                <div class="form-control-feedback">
                                    <i class="icon-lock2 text-muted">
                                    </i>
                                </div>
                            </div>
                            <div class="form-group d-flex align-items-center">
                                <div class="form-check mb-0">
                                    <label class="form-check-label">
                                        <input type="checkbox" id="checkbox" class="form-input-styled"> Lihat Password
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-block">Masuk
                                    <i class="icon-circle-right2 ml-2">
                                    </i>
                                </button>
                            </div>

                        </div>
                    </div>
                </form>
                <!-- /login card -->
            </div>
            <!-- /content area -->
        </div>
        <!-- /main content -->
    </div>
    <!-- /page content -->
    <script>
        $(document).ready(function() {
            $('#checkbox').on('change', function() {
                $('#password').attr('type', $('#checkbox').prop('checked') == true ? "text" : "password");
            });
        });
    </script>
</body>

</html>
