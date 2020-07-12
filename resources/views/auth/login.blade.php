<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Demo App</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- flag-icon-css -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.3.0/css/flag-icon.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="/">
    <font color='#007bff'>
    <b>
    <img width="100" height="100" src="{{asset('/dist/img/AdminLTELogo.png')}}"
           alt="Flare"
           class="brand-image img-circle elevation-3"
           style="opacity: .8">     
    <br>
    <h2>Demo App</h2>
    </font>
    </b>    
    </a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign In</p>
      <form action="{{ route('login') }}" method="post">
    	@csrf
        <div class="input-group mb-3">
          <input id="email" type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}"  placeholder="{{ __('login.email') }}" required autofocus>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
          @if ($errors->has('email'))
          <span class="error invalid-feedback">
                <strong>{{ $errors->first('email') }}</strong>
          </span>
      		@endif          
        </div>
        <div class="input-group mb-3">
          <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="{{ __('login.password') }}" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
          @if ($errors->has('password'))
          <span class="error invalid-feedback">
                <strong>{{ $errors->first('password') }}</strong>
          </span>
      		@endif
        </div>
        <div class="text-center">
          <button type="submit" class="btn btn-primary btn-block">@php echo Lang::get('login.sign_in');@endphp</button>
        </div>
           <div class="icheck-primary">
              <input type="checkbox" id="remember" name="remember">
              <label for="remember">
              {{ __('login.remember_me') }}
              </label>
            </div>
       </form>

      <div class="social-auth-links text-center mb-3">
        <p>- OR -</p>
        <a href="{{url('/redirect')}}" class="btn btn-block btn-primary">
          <i class="fab fa-facebook mr-2"></i>{{ __('login.sign_in_facebook') }}
        </a>
        <!-- <a href="#" class="btn btn-block btn-danger">
          <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
        </a>
        <a href="#" class="btn btn-block bg-maroon toastsDefaultMaroon">
          <i class="fab fa-instagram mr-2"></i> Sign in using Instagram
        </a> -->
      </div>
      <!-- /.social-auth-links -->

      <p class="mb-1">
        <a href="{{ route('password.request') }}">{{ __('login.forgot_pass') }}</a>
      </p>
      <p class="mb-0">
        <a href="{{ route('register') }}" class="text-center">{{ __('login.register') }}</a>
      </p>
      <p class="mb-0">&nbsp;
      </p>
      <p class="mb-0">&nbsp;
      </p>
      <p class="mb-1 text-center">
      <strong>Copyright &copy; 2020 <a href="/">Demo App</a>.</strong><br>
      All rights reserved.
      </p>

    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('dist/js/adminlte.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('dist/js/demo.js')}}"></script>

</body>
</html>
