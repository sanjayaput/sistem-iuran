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
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
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
  <body class="bg-slate-800">
    <!-- Page content -->
    <div class="page-content">
      <!-- Main content -->
      <div class="content-wrapper">
        <!-- Content area -->
        <div class="content d-flex justify-content-center align-items-center">
          <!-- Login card -->
          <form class="form-login col-md-3 form-validate" method="POST" action="{{ route('login') }}">
            {{ csrf_field() }}
            <div class="card mb-0 ">
              <div class="card-body">
                <div class="text-center mb-3">
                  <!-- <i class="icon-user-lock icon-2x text-warning-400 border-warning-400 border-3 rounded-round p-3 mb-3 mt-1">
                  </i> -->
                  <img src="{{ asset('assets/global/images/logo-desa.png') }}" width="200" height="200" class="rounded-circle" alt="" />
                  <!-- <img class="card-img-top img-fluid" src="{{ URL::to('/') }}/assets/global/images/logo.png" alt=""> -->
                  <h5 class="mb-0">Login
                  </h5>
                  <span class="d-block text-muted">{{ config('') }}SISTEM INFORMASI PENGELOLAAN KEUANGAN <br>DESA ADAT ASAK 
                  </span>
                  @if (session('error'))
                  <div class="alert mt-2 alert-danger alert-dismissible">
									<button type="button" class="close" data-dismiss="alert"><span>×</span></button>
									{{ session('error') }}
							    </div>
                  @endif
                </div>
                <div class="form-group form-group-feedback form-group-feedback-left{{ $errors->has('email') ? ' has-error' : '' }}">
                  <input id="email" type="email" class="form-control" placeholder="Email" name="email" value="{{ old('email') }}" required autofocus>
                  @if ($errors->has('email'))
                  <span class="text-danger">
                    {{ $errors->first('email') }}
                  </span>
                  @endif
                  <div class="form-control-feedback">
                    <i class="icon-user text-muted">
                    </i>
                  </div>
                </div>
                <div class="form-group form-group-feedback form-group-feedback-left{{ $errors->has('password') ? ' has-error' : '' }}">
                  <input id="password" type="password" placeholder="Sandi" class="form-control" name="password" required>
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
    $(document).ready(function(){
        $('#checkbox').on('change', function(){
            $('#password').attr('type',$('#checkbox').prop('checked')==true?"text":"password"); 
        });
    });
</script>
  </body>
</html>
