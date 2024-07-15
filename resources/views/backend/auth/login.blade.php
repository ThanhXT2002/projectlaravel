<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login-Admin</title>
    @include('backend.layout.component.head')
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-pink">
            <div class="text-center">
                <img width=300px, src="backend/img/logo/logo-prettyeyes.png" alt="">
            </div>
            <div class="card-body">
                <h3 class="login-box-msg text-pink"><strong>Login Admin</strong></h3>

                <form action="{{ route('auth.login')}}" method="post">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="email" class="form-control rounded-0" value="Thanh2002@gmail.com" name="email" placeholder="Email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    @if ($errors->has('email'))
                    <i class ="text-danger text-left">* {{ $errors->first('email') }}</i>
                    @endif

                    <div class="input-group mb-3">
                        <input type="password" class="form-control rounded-0" name="password" placeholder="Password" value="123456">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    @if ($errors->has('password'))
                            <i class ="text-danger text-left">* {{ $errors->first('password') }}</i>
                    @endif
                    <div class="my-3">
                        <button type="submit" class="btn btn-success btn-block rounded-0"><strong>Login</strong></button>
                    </div>
                </form>

                <p class="mb-1">
                    <a href="forgot-password.html">I forgot my password</a>
                </p>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.login-box -->
    @include('backend.layout.component.scripts')
</body>
</html>
