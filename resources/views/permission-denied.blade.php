<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="SLIIT">

    <link rel="shortcut icon" href="{{asset('images/favicon_1.ico')}}">

    <title>Plan My Event</title>

    <!-- Base Css Files -->
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet" />

    <!-- Font Icons -->
    <link href="{{asset('assets/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/ionicon/css/ionicons.min.css')}}" rel="stylesheet" />
    <link href="{{asset('css/material-design-iconic-font.min.css')}}" rel="stylesheet">

    <!--Calendar-->
    <link href="{{asset('assets/fullcalendar/fullcalendar.css')}}" rel="stylesheet" />

    <!-- animate css -->
    <link href="{{asset('css/animate.css')}}" rel="stylesheet'" />

    <!-- Waves-effect -->
    <link href="{{asset('css/waves-effect.css')}}" rel="stylesheet">

    <!-- sweet alerts -->
    <link href="{{asset('assets/sweet-alert/sweet-alert.min.css')}}" rel="stylesheet">

    <!-- Custom Files -->
    <link href="{{asset('css/helper.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('css/style.css')}}" rel="stylesheet" type="text/css" />

    <!-- Plugins css -->
    <link href="{{asset('assets/modal-effect/css/component.css')}}" rel="stylesheet">

    <style>
        #modal-11 a, #modal-11 p{
            color: #fff !important;
        }
    </style>
        
    @yield('header-js')

    @yield('header-css')

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

    <script src="{{asset('js/modernizr.min.js')}}"></script>
    <script src="{{asset('js/cookie.js')}}"></script>

    <script>
    function checkSidebarState(){
        if(getCookie("sidebarState")=="forced enlarged"){
            document.getElementById("wrapper").className = "forced enlarged";
        } else{
            document.getElementById("wrapper").className = "forced";
        }
    }
    </script>
    

</head>

<body class="fixed-left">
<!-- Begin page -->
<div id="wrapper">

    <script>
        if(getCookie("sidebarState")=="forced enlarged"){
            document.getElementById("wrapper").className = "forced enlarged";
        } else{
            document.getElementById("wrapper").className = "forced";
        }
    </script>

    <!-- Top Bar Start -->
    <div class="topbar">
        <!-- LOGO -->
        <div class="topbar-left">
            <div class="text-center">
                <a href="{{ url('/') }}" class="logo"><i class="md md-event"></i> <span>PLAN MY EVENT </span></a>
            </div>
        </div>
        <!-- Button mobile view to collapse sidebar menu -->
        <div class="navbar navbar-default" role="navigation">
            <div class="container">
                <div class="">
                    <div class="pull-left">
                        <button class="button-menu-mobile open-left">
                            <i class="fa fa-bars"></i>
                        </button>
                        <span class="clearfix"></span>
                    </div>
                    <div class="navbar-form pull-left" style="font-family: 'Nunito', sans-serif; color: #FFF; line-height: 54px; margin-left: 10px; font-size: 16px;">
                        We Make YOUR Event Creative, Exciting and Unique.
                    </div>

                    <ul class="nav navbar-nav navbar-right pull-right">
                        <li class="hidden-xs">
                            <a href="#" id="btn-fullscreen" class="waves-effect waves-light"><i class="md md-crop-free"></i></a>
                        </li>
                        <li class="dropdown">
                            <a href="" class="dropdown-toggle profile" data-toggle="dropdown" aria-expanded="true"><img src="{{ (empty(Auth::user()->avatar)) ? URL::to('/images/users/avatar.png') : Auth::user()->avatar }}" alt="user-img" class="img-circle"> </a>
                            <ul class="dropdown-menu">
                                <li><a href="{{ url('/dashboard/profile') }}"><i class="md md-face-unlock"></i> Profile</a></li>
                                <li><a href="{{ url('/dashboard/settings') }}"><i class="md md-settings"></i> Settings</a></li>
                                <li><a href="javascript:;" class="md-trigger" style="font-family: 'Nunito', sans-serif;" data-modal="modal-11"><i class="md md-loop"></i> Change Role</a></li>                                                   
                                <li><a href="{{ url('logout') }}"><i class="md md-settings-power"></i> Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <!--/.nav-collapse -->
            </div>
        </div>
    </div>
    <!-- Top Bar End -->


    <div class="content-page" style="margin-left: 0 !important;">
	    <div class="content">
	        	<div class=" vertical-center" style="text-align: center; margin-top: 95px;">
	        		<img src="{{asset('images/warning.png')}}" />
		    	    <h1>Permission Denied</h1>
				    <h4>Aplogies! You don't have enough permissions to access this page.</h4>
				    <h5>If you think you got this message by error please contact our support team</h5>

                    <a href="{{ url('dashboard') }}"><button style="margin-top: 35px;" class="btn btn-lg btn-info waves-effect waves-light m-b-5"> <i class="fa fa-home"></i> <span>Back to Dashboard</span> </button></a>
				</div>
		</div>

        <footer class="footer text-center">
            © 2016 Sri Lanka Institute of Information Technology. All Rights Reserved.<br>
            <strong>Team Members:</strong> <a href="{{ url('dashboard/developers') }}">Gayan</a>, <a href="{{ url('dashboard/developers') }}">Udesh</a>, <a href="{{ url('/developers') }}">Hasitha</a>, <a href="{{ url('/developers') }}">Lasanthi</a>
        </footer>
    </div>
<!-- END wrapper -->

<script>
    var resizefunc = [];
</script>

<!-- jQuery  -->
<script src="{{asset('js/jquery.min.js')}}"></script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<script src="{{asset('js/waves.js')}}"></script>
<script src="{{asset('js/wow.min.js')}}"></script>
<script src="{{asset('js/jquery.nicescroll.js')}}" type="text/javascript"></script>
<script src="{{asset('js/jquery.scrollTo.min.js')}}"></script>
<script src="{{asset('assets/jquery-sparkline/jquery.sparkline.min.js')}}"></script>
<script src="{{asset('assets/jquery-detectmobile/detect.js')}}"></script>
<script src="{{asset('assets/click/click.js')}}"></script>
<script src="{{asset('assets/jquery-slimscroll/jquery.slimscroll.js')}}"></script>
<script src="{{asset('assets/jquery-blockui/jquery.blockUI.js')}}"></script>

<!-- sweet alerts -->
<script src="{{asset('assets/sweet-alert/sweet-alert.min.js')}}"></script>
<script src="{{asset('assets/sweet-alert/sweet-alert.init.js')}}"></script>

<!-- Calendar -->
<script src="{{asset('assets/fullcalendar/moment.min.js')}}"></script>
<script src="{{asset('assets/fullcalendar/fullcalendar.min.js')}}"></script>
<script src="{{asset('assets/fullcalendar/fullcalendar.js')}}"></script>

<!-- Counter-up -->
<script src="{{asset('assets/counterup/waypoints.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/counterup/jquery.counterup.min.js')}}" type="text/javascript"></script>

<!-- CUSTOM JS -->
<script src="{{asset('js/jquery.app.js')}}"></script>

<!-- Dashboard -->
<script src="{{asset('js/jquery.dashboard.js')}}"></script>

<!-- Todo -->
<script src="{{asset('js/jquery.todo.js')}}"></script>

</body>
</html>