

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="SLIIT">

    @yield('meta')

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

    <!-- Preloader -->
    <link rel="stylesheet" type="text/css" media="screen" href="{{asset('css/loaders.min.css')}}">

    <style>
        #modal-11 a, #modal-11 p{
            color: #fff !important;
        }
    </style>
        
    @yield('header-js')

    <script>
    function showPreloader(){
        document.getElementById('preloader').style.visibility="visible";
    }

    function hidePreloader(){
        document.getElementById('preloader').style.visibility="hidden";
    }
    </script>

    <script src="//js.pusher.com/2.2/pusher.min.js"></script>

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

    var ModalEffects = (function() 
    {

    function init2() 
    {
        var type = "<?php echo Session::get('type'); ?>";
        var title = "<?php echo Session::get('title'); ?>";
        var message = "<?php echo Session::get('message'); ?>";
        sweetAlert(title, message, type);
    }

    @if(Session::has('message'))
        window.onload  = function() {
            init2(); 
        };
    @endif       

    })();

    </script>

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
<div id="preloader">
    <div id="loader" class="loader-inner line-scale">
          <div></div>
          <div></div>
          <div></div>
          <div></div>
          <div></div>
        </div>
</div>

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
                <a href="{{ url('/dashboard') }}" class="logo"><i class="md md-event"></i> <span>PLAN MY EVENT </span></a>
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
                            <a href="{{ url('/') }}" class="waves-effect waves-light"><i class="md md-home"></i></a>
                        </li>
                        <li class="dropdown hidden-xs">
                            <a href="#" data-target="#" class="dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-expanded="true" onclick="$('#message-count').text('');" >
                                <i class="md md-question-answer"></i>
                                <span id="message-count" class="badge badge-xs badge-danger">1</span>
                            </a>
							
                            <ul id="messages"  class="dropdown-menu dropdown-menu-lg" style="width: 475px;">
                                <li class="message-title"><span class="label label-default pull-right">0 New</span>Messages</li>
                                <li class="list-group">
                                    <!-- list item-->
                                    <!-- list item-->
                                    <div>
                                        <a href="javascript:void(0);" class="list-group-item">
                                            <div class="media">
                                                <div class="pull-left p-r-10">
                                                    <em class="fa fa-envelope fa-2x text-custom"></em>
                                                </div>
                                                <div class="media-body">
                                                    <h5 class="media-heading">Inquiry about photography package prices for a Wedding</h5>
                                                    <p class="m-0">
                                                        <small>Hasitha Jayasinghe</small>
                                                    </p>

                                                    <p class="m-0" style="color: #14ADF3;">
                                                        <small>5 days ago</small>
                                                    </p>
                                                </div>
                                            </div>
                                        </a>
                                    </div>

                                    <div>
                                        <a href="javascript:void(0);" class="list-group-item">
                                            <div class="media">
                                                <div class="pull-left p-r-10">
                                                    <em class="fa fa-envelope fa-2x text-custom"></em>
                                                </div>
                                                <div class="media-body">
                                                    <h5 class="media-heading">Request for getting list of venues for a party around Nugegoda</h5>
                                                    <p class="m-0">
                                                        <small>Udesh Hewagama</small>
                                                    </p>

                                                    <p class="m-0" style="color: #14ADF3;">
                                                        <small>1 day ago</small>
                                                    </p>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <!-- list item-->

                                    <a href="{{ url('/dashboard/all-notifications') }}" class="list-group-item">
                                        <small>See all messages</small>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <?php
                            use Carbon\Carbon;

                                $notification_count = DB::table('notifications')
                                        ->select('title')
                                        ->where('for', Auth::User()->id)
                                        ->orWhere('for', Auth::User()->role)
                                        ->count();

                                $unread_notification_count = DB::table('notifications')
                                        ->select('title')
                                        ->where('readStatus', '=', '0')
                                        ->where(function ($query) {
                                            $query->where('for', Auth::User()->id)
                                                  ->orWhere('for', Auth::User()->role);
                                        })
                                        
                                        ->count();
                            ?>

                            @if($notification_count != 0)
                                <?php
                                    $notifications = DB::table('notifications')
                                            ->select('title', 'body', 'readStatus', 'link', 'icon', 'created_at')
                                            ->where('for', Auth::User()->id)
                                            ->orWhere('for', Auth::User()->role)
                                            ->orderBy('created_at', 'desc')
                                            ->limit(5)
                                            ->get();
                                ?>
                            @endif
                        
                        <li class="dropdown hidden-xs">
                            <a href="#" data-target="#" class="dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-expanded="true" onclick="$('#notificount').text(''); setReadStatus()">
                                <i class="md md-notifications"></i>
                                <span id="notificount" class="badge badge-xs badge-danger">@if($unread_notification_count != 0) {{$unread_notification_count}} @endif</span>
                            </a>    

                            <ul id="notification"  class="dropdown-menu dropdown-menu-lg">
                                <li class="notifi-title"><span id="notificationNum" class="label label-default pull-right">{{$unread_notification_count}} New</span>Notifications</li>
                                <li class="list-group notification-list" id="notificationList">
                                    <!-- list item-->
                                    <!-- list item-->
                                    <div id="notifill">
                                                @if($notification_count != 0)
                                                    @foreach($notifications as $notification)
                                                        @if($notification->readStatus == 0)
                                                            <a href="{{$notification->link}}" class="list-group-item list-group-item-success">
                                                        @else
                                                            <a href="{{$notification->link}}" class="list-group-item">
                                                        @endif
                                                            <div class="media">
                                                                <div class="pull-left p-r-10">
                                                                    <em class="fa {{$notification->icon}} fa-2x text-custom"></em>
                                                                </div>
                                                                <div class="media-body">
                                                                    <h5 class="media-heading">{{$notification->title}}</h5>
                                                                    <p class="m-0">
                                                                        <small>{{$notification->body}}</small>
                                                                    </p>

                                                                    <p class="m-0" style="color: #14ADF3;">
                                                                        <?php
                                                                            $timeAgo = Carbon::createFromTimeStamp(strtotime($notification->created_at))->diffForHumans();
                                                                        ?>
                                                                        <small>{{ $timeAgo }}</small>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    @endforeach
                                                @endif
                                    </div>
                                    <!-- list item-->

                                    <a href="{{ url('/dashboard/all-notifications') }}" class="list-group-item">
                                        <small>See all notifications</small>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="hidden-xs">
                            <a href="#" id="btn-fullscreen" class="waves-effect waves-light"><i class="md md-crop-free"></i></a>
                        </li>
                        <li class="dropdown">
                            <a href="" class="dropdown-toggle profile" data-toggle="dropdown" aria-expanded="true"><img onError="this.onerror=null;this.src='{{asset('/images/users/avatar.png')}}';" src="{{ (empty(Auth::user()->avatar)) ? URL::to('/images/users/avatar.png') : Auth::user()->avatar }}" alt="user-img" class="img-circle"> </a>
                            <ul class="dropdown-menu">
                                <li><a href="{{ url('/dashboard/profile') }}"><i class="md md-face-unlock"></i> Profile</a></li>
                                <li><a href="{{ url('/dashboard/settings') }}"><i class="md md-settings"></i> Settings</a></li>
                                @if(Auth::user()->role == 'admin')
                                    <li><a href="javascript:;" class="md-trigger" style="font-family: 'Nunito', sans-serif;" data-modal="modal-11"><i class="md md-loop"></i> Change Role</a></li>                                                   
                                
                                @endif
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


    <!-- ========== Left Sidebar Start ========== -->

    <div class="left side-menu">
        <div class="sidebar-inner slimscrollleft">
            <div class="user-details">
                <div class="pull-left">
                    <img onError="this.onerror=null;this.src='{{asset('/images/users/avatar.png')}}';" src="{{ (empty(Auth::user()->avatar)) ? URL::to('/images/users/avatar.png') : Auth::user()->avatar }}" alt="" class="thumb-md img-circle">
                </div>
                <div class="user-info">
                    <div class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">{{{ Auth::user()->name }}} <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ url('/dashboard/profile') }}"><i class="md md-face-unlock"></i> Profile<div class="ripple-wrapper"></div></a></li>
                            <li><a href="{{ url('/dashboard/settings') }}"><i class="md md-settings"></i> Settings</a></li>
                            <li><a href="{{ url('logout') }}"><i class="md md-settings-power"></i> Logout</a></li>
                        </ul>
                    </div>
                   


                    <p class="text-muted m-0"><?php echo $userRole; ?></p>
                </div>
            </div>
            <!--- Divider -->
            <div id="sidebar-menu">
                <ul>
                    <li>
                        <a href="{{ url('dashboard') }}" class="waves-effect {{ Request::is('dashboard') ? 'active' : null }}"><i class="md md-dashboard"></i><span> Dashboard </span></a>
                    </li>
                    
                        <li class="has_sub">
                            <a href="{{ url('dashboard/events/*') }}" class="waves-effect {{ Request::is('dashboard/events*') && !(Request::is('dashboard/events/categories*'))  ? 'active' : null }}"><i class="md md-event"></i><span> Events </span></a>
                            <ul class="list-unstyled">
                                <?php if($userRole == "Administrator" || $userRole == "Event Planner" || $userRole == "Team Member"){?>
                                   <li class="{{ Request::is('dashboard/events/view-all') ? 'active' : null }}"><a href="{{ url('/dashboard/events/view-all') }}">View All</a></li>
                                <?php }; ?>

                                <?php if($userRole == "Customer"){?>
                                   <li class="{{ Request::is('dashboard/events/customerevents') ? 'active' : null }}"><a href="{{ url('/dashboard/events/customerevents') }}">My Events</a></li>
                                <?php }; ?>

                                <?php if($userRole == "Administrator"){?>
                                   <li class="{{ Request::is('dashboard/events/customerevents') ? 'active' : null }}"><a href="{{ url('/dashboard/events/customerevents') }}">Customer Events</a></li>
                                <?php }; ?>
                                
                                <?php if($userRole == "Team Member"){?>
                                    <li class="{{ Request::is('dashboard/events/myevents') ? 'active' : null }}"><a href="{{ url('/dashboard/events/myevents') }}">My Events</a></li>
                                <?php }; ?>
                            </ul>
                        </li>               
                    
                    <?php if($userRole == "Administrator"){?>
                        <li class="has_sub">
                            <a class="waves-effect {{ Request::is('dashboard/messages*') ? 'active' : null }}"><i class="md md-question-answer"></i><span> Messages </span><span class="pull-right"><i class="md md-add"></i></span></a>
                            <ul class="list-unstyled">
                                <li class="{{ Request::is('dashboard/messages/new*') ? 'active' : null }}"><a href="{{ url('/dashboard/messages/new') }}">New Message</a></li>
                                <li class="{{ Request::is('dashboard/messages/inbox*') ? 'active' : null }}"><a href="{{ url('/dashboard/messages/inbox') }}">Inbox (2)</a></li>
                                <li class="{{ Request::is('dashboard/messages/sent*') ? 'active' : null }}"><a href="{{ url('/dashboard/messages/sent') }}">Drafts (1)</a></li>
                                <li class="{{ Request::is('dashboard/messages/sent*') ? 'active' : null }}"><a href="{{ url('/dashboard/messages/sent') }}">Sent Items</a></li>
                            </ul>
                        </li>
                    <?php }; ?>
                    
                    <?php if($userRole == "Administrator"){?>
                        <li>
                            <a href="{{ url('dashboard/calendar') }}" class="waves-effect {{ Request::is('dashboard/calendar*') ? 'active' : null }}"><i class="md md-event"></i><span> Calendar </span></a>
                        </li>
                    <?php }; ?>
                    
                    <?php if($userRole == "Administrator"){?>
                        <li>
                            <a href="{{ url('dashboard/users') }}" class="waves-effect {{ Request::is('dashboard/users*') ? 'active' : null }}"><i class="md md-people"></i><span> Users </span></a>
                        </li>
                    <?php }; ?>

                    

                    <?php if($userRole == "Administrator"){?>
                        <li>
                            <a href="{{ url('dashboard/question-builder') }}" class="waves-effect {{ Request::is('dashboard/question-builder*') ? 'active' : null }}"><i class="md  md-live-help"></i><span> Question Builder </span></a>
                        </li>
                    <?php }; ?>

                    <?php if($userRole == "Administrator"){?>
                        <li>
                            <a class="waves-effect {{ Request::is('dashboard/services*') ? 'active' : null }}"><i class="md md-brightness-5"></i><span> Services </span></a>
                            <ul class="list-unstyled">
                                <li class="{{ Request::is('dashboard/services') ? 'active' : null }}"><a href="{{ url('/dashboard/services') }}">View All</a></li>
                                <li class="{{ Request::is('dashboard/services/add') ? 'active' : null }}"><a href="{{ url('/dashboard/services/add') }}">Add New</a></li>
                            </ul>
                        </li>
                     <?php }; ?>
                    
                    <?php if($userRole == "Administrator"){?>
                        <li>
                            <a class="waves-effect {{ Request::is('dashboard/service-providers*') ? 'active' : null }}"><i class="md md-business"></i><span> Service Providers </span></a>
                            <ul class="list-unstyled">
                                <li class="{{ Request::is('dashboard/service-providers') ? 'active' : null }}"><a href="{{ url('/dashboard/service-providers') }}">View All</a></li>
                                <li class="{{ Request::is('dashboard/service-providers/add') ? 'active' : null }}"><a href="{{ url('/dashboard/service-providers/add') }}">Add New</a></li>
                            </ul>
                        </li>
                        </li>
                     <?php }; ?>

                     <?php if($userRole == "Administrator" || $userRole = "Customer"){?>
                        <li>
                            <a class="waves-effect {{ Request::is('dashboard/events/categories') ? 'active' : null }}"><i class="md md-folder-special"></i><span> Event Categories </span></a>
                            <ul class="list-unstyled">
                                <li class="{{ Request::is('dashboard/events/categories') ? 'active' : null }}"><a href="{{ url('/dashboard/events/categories') }}">View All</a></li>
                                <li class="{{ Request::is('dashboard/events/categories/add') ? 'active' : null }}"><a href="{{ url('/dashboard/events/categories/add') }}">Add New</a></li>
                            </ul>
                        </li>
                    <?php }; ?>

                    <?php if($userRole == "Administrator"){?>
                        <li>
                            <a class="waves-effect {{ Request::is('dashboard/events/categories/tasks*') ? 'active' : null }}"><i class="md md-check-box"></i><span> Event Tasks</span></a>

                            <ul class="list-unstyled">
                                <li class="{{ Request::is('dashboard/events/categories/tasks') ? 'active' : null }}"><a href="{{ url('/dashboard/events/categories/tasks') }}">View All</a></li>
                                <li class="{{ Request::is('dashboard/events/categories/add') ? 'active' : null }}"><a href="{{ url('/dashboard/events/assign-tasks') }}">Assign Tasks</a></li>
                            </ul>
                        </li>
                    <?php }; ?>

                    <?php if($userRole == "Administrator"){?>
                        <li>
                            <a href="{{ url('dashboard/reviews') }}" class="waves-effect {{ Request::is('dashboard/reviews*') ? 'active' : null }}"><i class="md  md-star"></i><span> Reviews</span></a>
                        </li>
                    <?php }; ?>

                    <?php if($userRole == "Administrator"){?>
                        <li>
                            <a href="{{ url('dashboard/venues') }}" class="waves-effect {{ Request::is('dashboard/venues*') ? 'active' : null }}"><i class="md md-pin-drop"></i><span> Venues</span></a>
                        </li>
                    <?php }; ?>
                    
                    <?php if($userRole == "Customer"){?>
                        <li>
                            <a href="{{ url('dashboard/request-a-quote') }}" class="waves-effect {{ Request::is('dashboard/request-a-quote*') ? 'active' : null }}"><i class="md md-content-paste"></i><span> Request a Quote</span></a>
                        </li>
                    <?php }; ?>

                    <?php if($userRole == "Customer"){?>
                        <li>
                            <a href="{{ url('dashboard/view-quote-requests') }}" class="waves-effect {{ Request::is('dashboard/view-quote-requests*') ? 'active' : null }}"><i class="md md-my-library-books"></i><span> Quote Requests</span></a>
                        </li>
                    <?php }; ?>
                    
                    <?php if($userRole == "Administrator"){?>
                        <li>
                            <a href="{{ url('dashboard/quote-requests') }}" class="waves-effect {{ Request::is('dashboard/quote-requests*') ? 'active' : null }}"><i class="md md-my-library-books"></i><span> Quote Requests</span></a>
                        </li>
                    <?php }; ?>

                    <?php if($userRole == "Administrator"){?>
                        <li>
                            <a href="{{ url('dashboard/invoices') }}" class="waves-effect {{ Request::is('dashboard/invoices*') ? 'active' : null }}"><i class="md md-content-paste"></i><span> Invoices</span></a>
                        </li>
                    <?php }; ?>
                    
                    <?php if($userRole == "Administrator"){?>
                        <li>
                            <a href="{{ url('dashboard/payments') }}" class="waves-effect {{ Request::is('dashboard/payments*') ? 'active' : null }}"><i class="md md-payment"></i><span> Payments</span></a>
                        </li>
                    <?php }; ?>

                    <?php if($userRole == "Administrator"){?>
                        <li>
                            <a href="{{ url('dashboard/statistics') }}" class="waves-effect {{ Request::is('dashboard/statistics*') ? 'active' : null }}"><i class="md md-insert-chart"></i><span> Statistics</span></a>
                        </li>
                    <?php }; ?>

                    <?php if($userRole == "Administrator"){?>
                        <li>
                            <a href="{{ url('dashboard/feedbacks') }}" class="waves-effect {{ Request::is('dashboard/feedbacks*') ? 'active' : null }}"><i class="md  md-reply"></i><span> Feedbacks</span></a>
                        </li>
                    <?php }; ?>

                    <?php if($userRole == "Administrator"){?>
                        <li>
                            <a href="{{ url('dashboard/website-issues') }}" class="waves-effect {{ Request::is('dashboard/website-issues*') ? 'active' : null }}"><i class="md md-report"></i><span> Website Issues</span></a>
                        </li>
                    <?php }; ?>
                    
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <!-- Left Sidebar End -->

    <div class="content-page">
    
    <div class="md-modal md-effect-11" id="modal-11">
        <div class="md-content" style="background-color: #003B5D;">
            
            <div style="color: #fff;">
            <h2 style="color: #fff; text-align: center;">Change User Role</h2>
                <p style="text-align: center;">Click on the user role below to switch.</p>
                
                <div class="row" style="margin-top: 15px; margin-bottom: 20px;">
                    <a href="{{ url('dashboard/users/role/switch/admin') }}"><div class="col-sm-3">
                        <img src="{{asset('images/roles/admin.png')}}">
                        <p style="text-align: center;">Admin</p>
                    </div></a>

                    <a href="{{ url('dashboard/users/role/switch/customer') }}"><div class="col-sm-3">
                        <img src="{{asset('images/roles/customer.png')}}">
                        <p style="text-align: center;">Customer</p>
                    </div></a>

                    <a href="{{ url('dashboard/users/role/switch/event-planner') }}"><div class="col-sm-3">
                        <img src="{{asset('images/roles/event-planner.png')}}">
                        <p style="text-align: center;">Event Planner</p>
                    </div></a>

                    <a href="{{ url('dashboard/users/role/switch/team-member') }}"><div class="col-sm-3">
                        <img src="{{asset('images/roles/team-member.png')}}">
                        <p style="text-align: center;">Team Member</p>
                    </div></a>
                </div>

                <div class="row" style="text-align: center;"><button class="md-close-popup btn-lg btn-success waves-effect waves-light">Close</button></div>
            </div>
        </div>
    </div>


        @yield('content')
        <footer class="footer text-right">
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



<!-- Counter-up -->
<script src="{{asset('assets/counterup/waypoints.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/counterup/jquery.counterup.min.js')}}" type="text/javascript"></script>

<!-- CUSTOM JS -->
<script src="{{asset('js/jquery.app.js')}}"></script>

<!-- Dashboard -->
<script src="{{asset('js/jquery.dashboard.js')}}"></script>

@yield('footer-js')

<script type="text/javascript">
    jQuery(document).ready(function($) {
        @yield('jquery')
    });


        $('#notification').click(function() {

    var userid = $('#userid').val();
 

    $.ajax({
      type: "POST",
      url: "{{ url('dashboard/notifications') }}",
      data: {userid: userid, '_token': '{!! csrf_token() !!}'},
      cache: false,
      success: function(data)
      {
              //userid = $('#userid').val();
              $('#notificount').text(data);
      } 
    });


    });

    function pusher(){
        console.log("Pusher Called");

            Pusher.log = function(message) {
                if (window.console && window.console.log) {
                    window.console.log(message);
                }
            };

            var pusher = new Pusher('a0ef59cfa159704595e3', {
                cluster: 'ap1',
                encrypted: true
            });

            var channel = pusher.subscribe('test_channel');
            channel.bind('my_event', function(data) {
                console.log(data.message);
            });

    }

    function setReadStatus() {
        $.ajax({url: "{{URL::to('dashboard/setReadStatus')}}", success: function(result){
            console.log("setReadStatus success")
        }});
    }

</script>

<script>
    $.ajaxSetup(
    {
        headers:
        {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var pusher = new Pusher('a0ef59cfa159704595e3');

    var notificationsChannel = pusher.subscribe('notifications');

    notificationsChannel.bind('success_notification', function(notification) {
        var notification_count = 0;

        if($.trim($('#notificount').html()) != ''){
            notification_count = parseInt($('#notificount').text());
        }

        var title = notification.title;
        var message = notification.message;
        var link = notification.link;
        var icon = notification.icon;

        console.log(parseInt(notification_count) + 1);
        $('#notificount').text(parseInt(notification_count) + 1); //Increase notification count
        $('#notificationNum').text(parseInt(notification_count) + 1+" New"); //Increase New Notifications Count
        $("#notificationList").prepend('<a href="' + link + '" class="list-group-item list-group-item-success"> <div class="media"> <div class="pull-left p-r-10"> <em class="fa ' + icon + ' fa-2x text-custom"></em> </div> <div class="media-body"> <h5 class="media-heading">' + title + '</h5> <p class="m-0"> <small>'+message+'</small> </p> <p class="m-0" style="color: #14ADF3;"><small>1 minute ago</small></p> </div> </div> </a>');
    });
</script>


<!-- Modal-Effect -->
        <script src="{{asset('assets/modal-effect/js/classie.js')}}"></script>
        <script src="{{asset('assets/modal-effect/js/modalEffects.js')}}"></script>

</body>
</html>