<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="IDBlog - IDStack Sample Blog Project from https://idstack.net">
  <meta name="author" content="https://idstack.net">
  <title>IDBlog - IDStack Sample Blog Project Admin</title>
  <!-- Bootstrap core CSS-->
  <link href="{{ asset('assets/blog-admin/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="{{ asset('assets/blog-admin/vendor/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
  <!-- Custom styles for this template-->
  <link href="{{ asset('assets/blog-admin/css/sb-admin.css') }}" rel="stylesheet">
</head>

<body class="bg-dark">
  <div class="container">
    <div class="card card-register mx-auto mt-5">
      <div class="card-header">Register an Account</div>
      <div class="card-body">
        <form class="form-horizontal" method="POST" action="{{ route('register') }}">
            {{ csrf_field() }}
            <div class="form-group">
                <div class="form-row">
                    <div class="col-md-12">
                        <label for="name" class="control-label">Name</label>
                        <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>
                        @if ($errors->has('name'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="email" class="control-label">E-Mail Address</label>
                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>
                @if ($errors->has('email'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group">
                <div class="form-row">
                <div class="col-md-6">
                    <label for="password" class="control-label">Password</label>
                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                    @if ($errors->has('password'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="col-md-6">
                    <label for="password-confirm" class="control-label">Confirm Password</label>
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                </div>
                </div>
            </div>
            <button class="btn btn-primary btn-block" type="submit">Register</button>
        </form>
        <div class="text-center">
          <a class="d-block small mt-3" href="{{ route('login') }}">Login Page</a>
          <a class="d-block small" href="{{ route('password.request') }}">Forgot Password?</a>
        </div>
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
