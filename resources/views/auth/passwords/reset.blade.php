<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
    <meta name="author" content="Coderthemes">

    <link rel="shortcut icon" href="{{asset('images/favicon_1.ico')}}">

    <title>Reset Password - Plan My Event</title>

    <!-- Base Css Files -->
    <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.min.css')}}"/>

    <!-- Font Icons -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/font-awesome/css/font-awesome.min.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('assets/ionicon/css/ionicons.min.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('css/material-design-iconic-font.min.css')}}"/>

    <!-- animate css -->
    <link rel="stylesheet" type="text/css" href="{{asset('css/animate.css')}}"/>

    <!-- Waves-effect -->
    <link rel="stylesheet" type="text/css" href="{{asset('css/wave-effect.css')}}"/>

    <!-- Custom Files -->
    <link rel="stylesheet" type="text/css" href="{{asset('css/helper.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('css/reset-pwd.css')}}"/>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

    <script src="{{asset('js/modernizr.min.js')}}"></script>

</head>
<body>


<div class="wrapper-page">
    <div class="panel panel-color panel-primary panel-pages">

        <div class="panel-heading" style="background-color: #008CFF;">
            <div class="bg-overlay"></div>
            <h3 class="text-center m-t-10 text-white">Enter New Password</h3>
        </div>

        <div class="panel-body">
                <form class="form-horizontal m-t-20" role="form" method="POST" action="{{ url('/password/reset') }}">
                    {!! csrf_field() !!}

                    <input type="hidden" name="token" value="{{ $token }}">

                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <div class="col-xs-12">
                            <input class="form-control input-lg" type="email" required="" placeholder="Email" name="email" value="{{ $email or old('email') }}">

                            @if ($errors->has('email'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <div class="col-xs-12">
                            <input class="form-control input-lg" type="password" required="" placeholder="Password" name="password">

                            @if ($errors->has('password'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                        <div class="col-xs-12">
                            <input class="form-control input-lg" type="password" required="" placeholder="Password" name="password_confirmation">

                            @if ($errors->has('password_confirmation'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group text-center m-t-40">
                        <div class="col-xs-12">
                            <button class="btn btn-success waves-effect waves-light btn-lg w-lg" type="submit"><i class="fa fa-btn fa-refresh"></i> Reset Password</button>
                        </div>
                    </div>
                </form>

        </div>

    </div>
</div>


<script>
    var resizefunc = [];
</script>
<script src="{{asset('js/jquery.min.js')}}"></script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<script src="{{asset('js/waves.js')}}"></script>
<script src="{{asset('js/wow.min.js')}}"></script>
<script src="{{asset('js/jquery.nicescroll.js')}}" type="text/javascript"></script>
<script src="{{asset('js/jquery.scrollTo.min.js')}}"></script>
<script src="{{asset('assets/jquery-detectmobile/detect.js')}}"></script>
<script src="{{asset('assets/fastclick/fastclick.js')}}"></script>
<script src="{{asset('assets/jquery-slimscroll/jquery.slimscroll.js')}}"></script>
<script src="{{asset('assets/jquery-blockui/jquery.blockUI.js')}}"></script>


<!-- CUSTOM JS -->
<script src="{{asset('js/modernizr.min.js')}}js/jquery.app.js"></script>

</body>
</html>