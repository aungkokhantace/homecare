<?php
$companyName = \App\Core\Check::companyName();
$companyLogo = \App\Core\Check::companyLogo();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/css/login.css" rel="stylesheet">


</head>
<body>
<div class="container">
    <div class="row middle">
        <div class="col-md-5 col-md-offset-3 login-left">
            <p id="logo"><strong>{{$companyName}}</strong></p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-5 col-md-offset-3 login-left">
            <div class="border">

                <div class="login">
                    Reset Password
                </div>
                <!-- Starting Form -->
                <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/email') }}">
                    {{ csrf_field() }}
                @if (session('status'))
                    <p class="alert alert-danger">
                        {{ session('status') }}
                    </p>
                @endif
                @if ($errors->has())
                    <p class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            {{ $error }}<br>
                        @endforeach
                    </p>
                @endif

                <div class="user">
                    <div class="col-md-2">
                        <label class="reset_pwd_lbl">Email</label>
                    </div>
                    <div class="col-md-9">
                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">


                    </div>
                </div>
                <div class="col-md-11 col-md-offset-1 gap">
                    <!-- -->
                </div>
                <!-- Inserting Password -->
                <div class="user">
                    <div class="col-md-offset-2 col-md-10">
                        <a href="/login" class="btn btn-lg fill_color reset_back_btn">
                            <span class="glyphicon glyphicon-circle-arrow-left"></span> Back
                        </a>

                        <button type="submit" class="btn btn-lg fill_color reset_btn">
                            <span class="glyphicon glyphicon-envelope"></span>    Send Password Reset Link
                        </button>
                    </div>
                </div>

                    <div class="col-md-11 col-md-offset-1 gap">
                        <!-- -->
                    </div>

                {!! Form::close() !!}
                        <!-- Ending Form -->
            </div>
        </div>
    </div>
    <br />
    <div class="row">
        <div class="col-md-5 col-md-offset-3 login-center">
            <img src="{{$companyLogo}}" class="pull-left height-full m-r-5 login_logo">
        </div>
    </div>
</div>
</body>
</html>