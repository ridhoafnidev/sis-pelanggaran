<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="IDBlog - IDStack Sample Blog Project from https://idstack.net">
  <meta name="author" content="https://idstack.net">
  <title>ISekolah - Login</title>
  <style>
    body {
      background-image: url("images/bg.jpg");
      background-repeat: no-repeat;
      background-size: cover;
      background-position: center bottom;
    }
  </style>
  <!-- Bootstrap core CSS-->
  <link href="{{ asset('assets/blog-admin/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="{{ asset('assets/blog-admin/vendor/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
  <!-- Custom styles for this template-->
  <link href="{{ asset('assets/blog-admin/css/sb-admin.css') }}" rel="stylesheet">
</head>

<body>
  <div class="container">
    <div class="card card-login mx-auto mt-5" style="margin-top:165px!important;">
      <div class="card-body">
        <form class="form-horizontal" method="POST" action="{{ route('login') }}">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="email">Username</label>
                <input id="email" type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
                @if ($errors->has('email'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group">
                <label for="password" class="control-label">Password</label>
                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                @if ($errors->has('password'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group">
                <div class="form-check">
                <label class="form-check-label">
                    <input class="form-check-input" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                </div>
            </div>
            <button class="btn btn-primary btn-block" type="submit">Login</button>
        </form>
        <!-- <div class="text-center">
            <a class="d-block small mt-3" href="{{ route('password.request') }}">Forgot Password?</a>
        </div> -->
      </div>
    </div>
  </div>
  <!-- Bootstrap core JavaScript-->
  <script src="{{ asset('assets/blog-admin/vendor/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('assets/blog-admin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <!-- Core plugin JavaScript-->
  <script src="{{ asset('assets/blog-admin/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
</body>

</html>
