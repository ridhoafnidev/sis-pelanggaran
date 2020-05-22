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
      <div class="card-header">Reset Password</div>
      <div class="card-body">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <form class="form-horizontal" method="POST" action="{{ route('password.email') }}">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="email" class="control-label">E-Mail Address</label>
                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>
                @if ($errors->has('email'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
            <button class="btn btn-primary btn-block" type="submit">Send Password Reset Link</button>
        </form>
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
