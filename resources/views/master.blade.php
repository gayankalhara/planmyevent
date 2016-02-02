<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
    <meta name="author" content="Coderthemes">

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

    @yield('header-css')

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

    <script src="{{asset('js/modernizr.min.js')}}"></script>

</head>



<body class="fixed-left">

<!-- Begin page -->
<div id="wrapper">

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
                        <li class="dropdown hidden-xs">
                            <a href="#" data-target="#" class="dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-expanded="true">
                                <i class="md md-notifications"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-lg">
                                <li class="text-center notifi-title">Notification</li>
                                <li class="list-group">
                                    <!-- list item-->
                                    <a href="javascript:void(0);" class="list-group-item">
                                        <div class="media">
                                            <div class="pull-left">
                                                <em class="fa fa-user-plus fa-2x text-info"></em>
                                            </div>
                                            <div class="media-body clearfix">
                                                <div class="media-heading">New user registered</div>
                                                <p class="m-0">
                                                    <small>gayan.csnc@gmail.com</small>
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                    <!-- list item-->

                                    <a href="{{ url('/all-notifications') }}" class="list-group-item">
                                        <small>See all notifications</small>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="hidden-xs">
                            <a href="#" id="btn-fullscreen" class="waves-effect waves-light"><i class="md md-crop-free"></i></a>
                        </li>
                        <li class="dropdown">
                            <a href="" class="dropdown-toggle profile" data-toggle="dropdown" aria-expanded="true"><img src="{{ Auth::user()->avatar }}" alt="user-img" class="img-circle"> </a>
                            <ul class="dropdown-menu">
                                <li><a href="{{ url('/profile') }}"><i class="md md-face-unlock"></i> Profile</a></li>
                                <li><a href="{{ url('/settings') }}"><i class="md md-settings"></i> Settings</a></li>
                                <li><a href="{{ url('/logout') }}"><i class="md md-settings-power"></i> Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <!--/.nav-collapse -->
            </div>
        </div>
    </div>
    <!-- Top Bar End -->


    <!-- ========== Left Sidebar Start ========== -->

    <div class="left side-menu">
        <div class="sidebar-inner slimscrollleft">
            <div class="user-details">
                <div class="pull-left">
                    <img src="{{ Auth::user()->avatar }}" alt="" class="thumb-md img-circle">
                </div>
                <div class="user-info">
                    <div class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">{{{ Auth::user()->name }}} <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="javascript:void(0)"><i class="md md-face-unlock"></i> Profile<div class="ripple-wrapper"></div></a></li>
                            <li><a href="javascript:void(0)"><i class="md md-settings"></i> Settings</a></li>
                            <li><a href="javascript:void(0)"><i class="md md-settings-power"></i> Logout</a></li>
                        </ul>
                    </div>

                    <p class="text-muted m-0">{{{ Auth::user()->email }}}</p>
                </div>
            </div>
            <!--- Divider -->
            <div id="sidebar-menu">
                <ul>
                    <li>
                        <a href="{{ url('/') }}" class="waves-effect active"><i class="md md-event"></i><span> Dashboard </span></a>
                    </li>

                    <li>
                        <a href="{{ url('/events/view-all') }}" class="waves-effect"><i class="md md-event"></i><span> All Events </span></a>
                    </li>

                    <li class="has_sub">
                        <a href="#" class="waves-effect"><i class="md md-mail"></i><span> Messages </span><span class="pull-right"><i class="md md-add"></i></span></a>
                        <ul class="list-unstyled">
                            <li><a href="{{ url('/messages/new') }}">New Message</a></li>
                            <li><a href="{{ url('/messages/inbox') }}">Inbox</a></li>
                            <li><a href="{{ url('/messages/sent') }}">Sent Items</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="{{ url('/calendar') }}" class="waves-effect"><i class="md md-event"></i><span> Calendar </span></a>
                    </li>

                    <li>
                        <a href="{{ url('/customers') }}" class="waves-effect"><i class="md md-person"></i><span> Customers </span></a>
                    </li>

                    <li>
                        <a href="{{ url('/team-members') }}" class="waves-effect"><i class="md md-people"></i><span> Team Members </span></a>
                    </li>

                    <li>
                        <a href="{{ url('/events/categories') }}" class="waves-effect"><i class="md md-event-note"></i><span> Event Categories </span></a>
                    </li>

                    <li>
                        <a href="{{ url('/service-providers') }}" class="waves-effect"><i class="md md-business"></i><span> Service Providers </span></a>
                    </li>

                    <li>
                        <a href="{{ url('/reviews') }}" class="waves-effect"><i class="md  md-star"></i><span> Reviews </span></a>
                    </li>

                    <li>
                        <a href="{{ url('/quote-requests') }}" class="waves-effect"><i class="md md-content-copy"></i><span> Quote Requests </span></a>
                    </li>

                    <li>
                        <a href="{{ url('/Invoices') }}" class="waves-effect"><i class="md md-content-paste"></i><span> Invoices </span></a>
                    </li>

                    <li>
                        <a href="{{ url('/payments') }}" class="waves-effect"><i class="md md-payment"></i><span> Payments </span></a>
                    </li>

                    <li>
                        <a href="{{ url('/statistics') }}" class="waves-effect"><i class="md md-insert-chart"></i><span> Statistics </span></a>
                    </li>

                    <li>
                        <a href="{{ url('/about-us') }}" class="waves-effect"><i class="md md-mood"></i><span> About Us</span></a>
                    </li>



                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <!-- Left Sidebar End -->

    <div class="content-page">
        @yield('content')
        <footer class="footer text-right">
            © 2016 Sri Lanka Institute of Information Technology. All Rights Reserved.<br>
            <strong>Team Members:</strong> Gayan, Udesh, Hasitha, Lasanthi
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
<script src="{{asset('assets/chat/moment-2.2.1.js')}}"></script>
<script src="{{asset('assets/jquery-sparkline/jquery.sparkline.min.js')}}"></script>
<script src="{{asset('assets/jquery-detectmobile/detect.js')}}"></script>
<script src="{{asset('assets/fastclick/fastclick.js')}}"></script>
<script src="{{asset('assets/jquery-slimscroll/jquery.slimscroll.js')}}"></script>
<script src="{{asset('assets/jquery-blockui/jquery.blockUI.js')}}"></script>

<!-- sweet alerts -->
<script src="{{asset('assets/sweet-alert/sweet-alert.min.js')}}"></script>
<script src="{{asset('assets/sweet-alert/sweet-alert.init.js')}}"></script>

<!-- flot Chart -->
<script src="{{asset('assets/flot-chart/jquery.flot.js')}}"></script>
<script src="{{asset('assets/flot-chart/jquery.flot.time.js')}}"></script>
<script src="{{asset('assets/flot-chart/jquery.flot.tooltip.min.js')}}"></script>
<script src="{{asset('assets/flot-chart/jquery.flot.resize.js')}}"></script>
<script src="{{asset('assets/flot-chart/jquery.flot.pie.js')}}"></script>
<script src="{{asset('assets/flot-chart/jquery.flot.selection.js')}}"></script>
<script src="{{asset('assets/flot-chart/jquery.flot.stack.js')}}"></script>
<script src="{{asset('assets/flot-chart/jquery.flot.crosshair.js')}}"></script>

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

<!-- Chat -->
<script src="{{asset('js/jquery.chat.js')}}"></script>

<!-- Todo -->
<script src="{{asset('js/jquery.todo.js')}}"></script>

@yield('footer-js')

<script type="text/javascript">
    /* ==============================================
     Counter Up
     =============================================== */
    jQuery(document).ready(function($) {
        $('.counter').counterUp({
            delay: 100,
            time: 1200
        });

        $('#calendar').fullCalendar( 'changeView', 'agendaWeek');

        @yield('jquery')
    });
</script>

</body>
</html>