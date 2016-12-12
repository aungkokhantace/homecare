<?php
$companyName = \App\Core\Check::companyName();
$companyLogo = \App\Core\Check::companyLogo();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Log In</title>
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
                     Log In
                </div>
                <!-- Starting Form -->
                {!! Form::open(array('url' => 'login'))!!}
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        @if ($errors->has())
                            <p class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    {{ $error }}<br>
                                @endforeach
                            </p>
                        @endif
                    <div class="user">
                        <div class="col-md-2">
                            <span class="glyphicon glyphicon-user user_color"></span>
                        </div>
                        <div class="col-md-9">
                            <input type="text" name="name" id="name" value="{{ Request::old('user_name') }}" class="form-control" placeholder="User ID">
                        </div>
                    </div>
                    <br>
                    <!-- Inserting Password -->
                    <div class="user">
                        <div class="col-md-2">
                            <span class="glyphicon glyphicon-lock user_color"></span>
                        </div>
                        <div class="col-md-9">
                            <input type="password" name="password" id="pw" class="form-control" placeholder="Password">
                        </div>
                    </div>

                    <div class="col-md-11 col-md-offset-1 gap">
                        <!-- -->
                    </div>

                <div class="row">
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-default fill_color login_btn" name="login">LOG IN</button>
                    </div>
                    <div class="col-md-7">
                            <a class="btn btn-link" href="{{ url('/password/reset') }}">Forgot Your Password?</a>

                    </div>
                </div>

                {!! Form::close() !!}
                <!-- Ending Form -->
            </div>
        </div>
    </div>
    <br />
    <div class="row">
        <div class="col-md-5 col-md-offset-4 login-center">
            <img src="{{$companyLogo}}" class="pull-left height-full m-r-5 login_logo">
        </div>
    </div>
</div>
</body>
</html>