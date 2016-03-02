<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
    <meta name="author" content="Coderthemes">

    <link rel="shortcut icon" href="images/favicon_1.ico">

    <title>Login to Plan My Event</title>

    <!-- Base Css Files -->
    <link href="css/bootstrap.min.css" rel="stylesheet" />

    <!-- Font Icons -->
    <link href="assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
    <link href="assets/ionicon/css/ionicons.min.css" rel="stylesheet" />
    <link href="css/material-design-iconic-font.min.css" rel="stylesheet">

    <!-- animate css -->
    <link href="css/animate.css" rel="stylesheet" />

    <!-- Waves-effect -->
    <link href="css/waves-effect.css" rel="stylesheet">

    <!-- Custom Files -->
    <link href="css/helper.css" rel="stylesheet" type="text/css" />
    <link href="css/style.css" rel="stylesheet" type="text/css" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

    <script src="js/modernizr.min.js"></script>

</head>
<body id="login">


<div class="wrapper-page">
    <div class="panel panel-color panel-primary panel-pages">
        <div class="panel-heading">
            <div class="bg-overlay"></div>
            <h3 class="text-center m-t-10 text-white"> Sign In to <strong>Plan My Event</strong> </h3>
        </div>

        <div class="panel-body">
            <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
            {!! csrf_field() !!}

                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <div class="col-xs-12">
                        <input class="form-control input-lg " name="email" type="email" required="" placeholder="Email Address" value="{{ old('email') }}">

                        @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <div class="col-xs-12">
                        <input class="form-control input-lg" type="password" name="password" required="" placeholder="Password">

                        @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>

                <div class="form-group ">
                    <div class="col-xs-12">
                        <div class="checkbox checkbox-success">
                            <input id="checkbox-signup" type="checkbox" name="remember">
                            <label for="checkbox-signup">
                                Remember me
                            </label>
                        </div>

                    </div>
                </div>

                <div class="form-group text-center m-t-40">
                    <div class="col-xs-12">
                        <button class="btn btn-success btn-lg w-lg waves-effect waves-light" type="submit"><i class="fa fa-btn fa-sign-in"></i> Log In</button>
                    </div>
                </div>

                <div class="form-group m-t-30">
                    <div class="col-sm-7">
                        <a href="{{ url('/password/reset') }}"><i class="fa fa-lock m-r-5"></i> Forgot your password?</a>
                    </div>
                    <div class="col-sm-5 text-right">
                        <a href="{{ url('/register') }}">Create an account</a>
                    </div>
                </div>

                <div class="form-group m-t-30">
                    <div class="col-sm-6">
                        <a href="{{ url('/auth/facebook') }}"><button type="button" style="width: 100%; height: 50px; background-color: #43609c; border: 1px solid #43609c;" class="btn btn-primary btn-rounded waves-effect waves-light m-b-5"><i class="fa fa-facebook m-r-5"></i> Facebook Login</button></a>
                    </div>

                    <div class="col-sm-6 text-right">
                        <a href="{{ url('/auth/google') }}"><button type="button" style="width: 100%; height: 50px; background-color: #df4a32;  border: 1px solid #df4a32;" class="btn btn-primary btn-rounded waves-effect waves-light m-b-5"><i class="fa fa-google-plus m-r-5"></i> Google+ Login</button></a>
                    </div>
                </div>

            </form>
        </div>

    </div>
</div>


<script>
    var resizefunc = [];
</script>
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/waves.js"></script>
<script src="js/wow.min.js"></script>
<script src="js/jquery.nicescroll.js" type="text/javascript"></script>
<script src="js/jquery.scrollTo.min.js"></script>
<script src="assets/jquery-detectmobile/detect.js"></script>
<script src="assets/fastclick/fastclick.js"></script>
<script src="assets/jquery-slimscroll/jquery.slimscroll.js"></script>
<script src="assets/jquery-blockui/jquery.blockUI.js"></script>


<!-- CUSTOM JS -->
<script src="js/jquery.app.js"></script>

</body>
</html>