<<<<<<< HEAD
 <?php
                        switch (session()->get('user_role')){
                            case "customer":
                                $userRole = "Customer";
                                break;

                            case "admin":
                                $userRole = "Administrator";
                                break;

                            case "event-planner":
                                $userRole = "Event Planner";
                                break;

                            case "team-member":
                                $userRole = "Team Member";
                                break;

                            default:
                                $userRole = "Unknown User";
                        }
                    ?>


=======
>>>>>>> e29ccdd27609c0470752dbc32f2bca356375a512
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<<<<<<< HEAD
    <meta name="author" content="SLIIT">

    @yield('meta')
=======
    <meta name="author" content="Coderthemes{{ Auth::user()->role }}">
>>>>>>> e29ccdd27609c0470752dbc32f2bca356375a512

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

<<<<<<< HEAD
    <!-- Preloader -->
    <link rel="stylesheet" type="text/css" media="screen" href="{{asset('css/loaders.min.css')}}">

=======
>>>>>>> e29ccdd27609c0470752dbc32f2bca356375a512
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
<<<<<<< HEAD
                <a href="{{ url('/dashboard') }}" class="logo"><i class="md md-event"></i> <span>PLAN MY EVENT </span></a>
=======
                <a href="{{ url('/') }}" class="logo"><i class="md md-event"></i> <span>PLAN MY EVENT </span></a>
>>>>>>> e29ccdd27609c0470752dbc32f2bca356375a512
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
<<<<<<< HEAD
                        <li class="hidden-xs">
                            <a href="{{ url('/') }}" class="waves-effect waves-light"><i class="md md-home"></i></a>
                        </li>
=======
>>>>>>> e29ccdd27609c0470752dbc32f2bca356375a512
                        <li class="dropdown hidden-xs">
                            <a href="#" data-target="#" class="dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-expanded="true">
                                <i class="md md-notifications"></i>
                            </a>
<<<<<<< HEAD

=======
>>>>>>> e29ccdd27609c0470752dbc32f2bca356375a512
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

<<<<<<< HEAD
                                    <a href="{{ url('/dashboard/all-notifications') }}" class="list-group-item">
=======
                                    <a href="{{ url('/all-notifications') }}" class="list-group-item">
>>>>>>> e29ccdd27609c0470752dbc32f2bca356375a512
                                        <small>See all notifications</small>
                                    </a>
                                </li>
                            </ul>
                        </li>
<<<<<<< HEAD
                        
=======
>>>>>>> e29ccdd27609c0470752dbc32f2bca356375a512
                        <li class="hidden-xs">
                            <a href="#" id="btn-fullscreen" class="waves-effect waves-light"><i class="md md-crop-free"></i></a>
                        </li>
                        <li class="dropdown">
                            <a href="" class="dropdown-toggle profile" data-toggle="dropdown" aria-expanded="true"><img src="{{ (empty(Auth::user()->avatar)) ? URL::to('/images/users/avatar.png') : Auth::user()->avatar }}" alt="user-img" class="img-circle"> </a>
                            <ul class="dropdown-menu">
<<<<<<< HEAD
                                <li><a href="{{ url('/dashboard/profile') }}"><i class="md md-face-unlock"></i> Profile</a></li>
                                <li><a href="{{ url('/dashboard/settings') }}"><i class="md md-settings"></i> Settings</a></li>
                                @if(Auth::user()->role == 'admin')
                                    <li><a href="javascript:;" class="md-trigger" style="font-family: 'Nunito', sans-serif;" data-modal="modal-11"><i class="md md-loop"></i> Change Role</a></li>                                                   
                                
                                @endif
                                <li><a href="{{ url('logout') }}"><i class="md md-settings-power"></i> Logout</a></li>
=======
                                <li><a href="{{ url('/profile') }}"><i class="md md-face-unlock"></i> Profile</a></li>
                                <li><a href="{{ url('/settings') }}"><i class="md md-settings"></i> Settings</a></li>
                                <li><a href="javascript:;" class="md-trigger" style="font-family: 'Nunito', sans-serif;" data-modal="modal-11"><i class="md md-loop"></i> Change Role</a></li>                                                   
                                <li><a href="{{ url('/logout') }}"><i class="md md-settings-power"></i> Logout</a></li>
>>>>>>> e29ccdd27609c0470752dbc32f2bca356375a512
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
                    <img src="{{ (empty(Auth::user()->avatar)) ? URL::to('/images/users/avatar.png') : Auth::user()->avatar }}" alt="" class="thumb-md img-circle">
                </div>
                <div class="user-info">
                    <div class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">{{{ Auth::user()->name }}} <span class="caret"></span></a>
                        <ul class="dropdown-menu">
<<<<<<< HEAD
                            <li><a href="{{ url('/dashboard/profile') }}"><i class="md md-face-unlock"></i> Profile<div class="ripple-wrapper"></div></a></li>
                            <li><a href="{{ url('/dashboard/settings') }}"><i class="md md-settings"></i> Settings</a></li>
                            <li><a href="{{ url('logout') }}"><i class="md md-settings-power"></i> Logout</a></li>
                        </ul>
                    </div>
                   
=======
                            <li><a href="{{ url('/profile') }}"><i class="md md-face-unlock"></i> Profile<div class="ripple-wrapper"></div></a></li>
                            <li><a href="{{ url('/settings') }}"><i class="md md-settings"></i> Settings</a></li>
                            <li><a href="{{ url('/logout') }}"><i class="md md-settings-power"></i> Logout</a></li>
                        </ul>
                    </div>
                    <?php
                        switch (session()->get('user_role')){
                            case "customer":
                                $userRole = "Customer";
                                break;

                            case "admin":
                                $userRole = "Administrator";
                                break;

                            case "event-planner":
                                $userRole = "Event Planner";
                                break;

                            case "team-member":
                                $userRole = "Team Member";
                                break;

                            default:
                                $userRole = "Unknown User";
                        }
                    ?>
>>>>>>> e29ccdd27609c0470752dbc32f2bca356375a512


                    <p class="text-muted m-0"><?php echo $userRole; ?></p>
                </div>
            </div>
            <!--- Divider -->
            <div id="sidebar-menu">
                <ul>
                    <li>
<<<<<<< HEAD
                        <a href="{{ url('dashboard') }}" class="waves-effect {{ Request::is('dashboard') ? 'active' : null }}"><i class="md md-dashboard"></i><span> Dashboard </span></a>
=======
                        <a href="{{ url('/') }}" class="waves-effect {{ Request::is('/') ? 'active' : null }}"><i class="md md-dashboard"></i><span> Dashboard </span></a>
>>>>>>> e29ccdd27609c0470752dbc32f2bca356375a512
                    </li>
                    
                    <?php if($userRole == "Administrator"){?>
                        <li>
<<<<<<< HEAD
                            <a href="{{ url('dashboard/events/view-all') }}" class="waves-effect {{ Request::is('events*') && !(Request::is('dashboard/events/categories*'))  ? 'active' : null }}"><i class="md md-event"></i><span> Events </span></a>
=======
                            <a href="{{ url('/events/view-all') }}" class="waves-effect {{ Request::is('events*') && !(Request::is('events/categories*'))  ? 'active' : null }}"><i class="md md-event"></i><span> Events </span></a>
>>>>>>> e29ccdd27609c0470752dbc32f2bca356375a512
                        </li>
                    <?php }; ?>
                    
                    <?php if($userRole == "Administrator"){?>
                        <li class="has_sub">
<<<<<<< HEAD
                            <a class="disabled waves-effect {{ Request::is('dashboard/messages*') ? 'active' : null }}"><i class="md md-question-answer"></i><span> Messages </span><span class="pull-right"><i class="md md-add"></i></span></a>
                            <ul class="list-unstyled">
                                <li class="{{ Request::is('dashboard/messages/new*') ? 'active' : null }}"><a href="{{ url('/dashboard/messages/new') }}">New Message</a></li>
                                <li class="{{ Request::is('dashboard/messages/inbox*') ? 'active' : null }}"><a href="{{ url('/dashboard/messages/inbox') }}">Inbox</a></li>
                                <li class="{{ Request::is('dashboard/messages/sent*') ? 'active' : null }}"><a href="{{ url('/dashboard/messages/sent') }}">Sent Items</a></li>
=======
                            <a href="#" class="waves-effect {{ Request::is('messages*') ? 'active' : null }}"><i class="md md-question-answer"></i><span> Messages </span><span class="pull-right"><i class="md md-add"></i></span></a>
                            <ul class="list-unstyled">
                                <li class="{{ Request::is('messages/new*') ? 'active' : null }}"><a href="{{ url('/messages/new') }}">New Message</a></li>
                                <li class="{{ Request::is('messages/inbox*') ? 'active' : null }}"><a href="{{ url('/messages/inbox') }}">Inbox</a></li>
                                <li class="{{ Request::is('messages/sent*') ? 'active' : null }}"><a href="{{ url('/messages/sent') }}">Sent Items</a></li>
>>>>>>> e29ccdd27609c0470752dbc32f2bca356375a512
                            </ul>
                        </li>
                    <?php }; ?>
                    
                    <?php if($userRole == "Administrator"){?>
                        <li>
<<<<<<< HEAD
                            <a href="{{ url('dashboard/calendar') }}" class="disabled waves-effect {{ Request::is('dashboard/calendar*') ? 'active' : null }}"><i class="md md-event"></i><span> Calendar </span></a>
=======
                            <a href="{{ url('/calendar') }}" class="waves-effect {{ Request::is('calendar*') ? 'active' : null }}"><i class="md md-event"></i><span> Calendar </span></a>
>>>>>>> e29ccdd27609c0470752dbc32f2bca356375a512
                        </li>
                    <?php }; ?>
                    
                    <?php if($userRole == "Administrator"){?>
                        <li>
<<<<<<< HEAD
                            <a href="{{ url('dashboard/users') }}" class="waves-effect {{ Request::is('dashboard/users*') ? 'active' : null }}"><i class="md md-people"></i><span> Users </span></a>
                        </li>
                    <?php }; ?>

                    

                    <?php if($userRole == "Administrator"){?>
                        <li>
                            <a href="{{ url('dashboard/question-builder') }}" class="waves-effect {{ Request::is('dashboard/question-builder*') ? 'active' : null }}"><i class="md  md-live-help"></i><span> Question Builder </span></a>
=======
                            <a href="{{ url('/customers') }}" class="waves-effect {{ Request::is('customers*') ? 'active' : null }}"><i class="md md-person"></i><span> Customers </span></a>
                        </li>
                    <?php }; ?>

                    <?php if($userRole == "Administrator"){?>
                        <li>
                            <a href="{{ url('/team-members') }}" class="waves-effect {{ Request::is('team-members*') ? 'active' : null }}"><i class="md md-people"></i><span> Team Members </span></a>
>>>>>>> e29ccdd27609c0470752dbc32f2bca356375a512
                        </li>
                    <?php }; ?>

                    <?php if($userRole == "Administrator"){?>
                        <li>
<<<<<<< HEAD
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
                            <a href="{{ url('dashboard/events/categories/tasks') }}" class="waves-effect {{ Request::is('dashboard/events/categories/tasks*') ? 'active' : null }}"><i class="md md-check-box"></i><span> Event Tasks </span></a>
                        </li>
                    <?php }; ?>

                    <?php if($userRole == "Administrator"){?>
                        <li>
                            <a href="{{ url('dashboard/reviews') }}" class="disabled waves-effect {{ Request::is('dashboard/reviews*') ? 'active' : null }}"><i class="md  md-star"></i><span> Reviews </span></a>
=======
                            <a href="{{ url('/events/categories') }}" class="waves-effect {{ Request::is('events/categories*') ? 'active' : null }}"><i class="md md-event-note"></i><span> Event Categories </span></a>
                        </li>
                    <?php }; ?>

                    <?php if($userRole == "Administrator"){?>
                        <li>
                            <a href="{{ url('/question-builder') }}" class="waves-effect {{ Request::is('question-builder*') ? 'active' : null }}"><i class="md  md-live-help"></i><span> Question Builder </span></a>
                        </li>
                    <?php }; ?>
                    
                    <?php if($userRole == "Administrator"){?>
                        <li>
                            <a href="{{ url('/service-providers') }}" class="waves-effect {{ Request::is('service-providers*') ? 'active' : null }}"><i class="md md-business"></i><span> Service Providers </span></a>
                        </li>
                     <?php }; ?>

                    <?php if($userRole == "Administrator"){?>
                        <li>
                            <a href="{{ url('/reviews') }}" class="waves-effect {{ Request::is('reviews*') ? 'active' : null }}"><i class="md  md-star"></i><span> Reviews </span></a>
>>>>>>> e29ccdd27609c0470752dbc32f2bca356375a512
                        </li>
                    <?php }; ?>
                    
                    <?php if($userRole == "Customer"){?>
                        <li>
<<<<<<< HEAD
                            <a href="{{ url('dashboard/request-a-quote') }}" class="waves-effect {{ Request::is('dashboard/request-a-quote*') ? 'active' : null }}"><i class="md md-content-paste"></i><span> Request a Quote </span></a>
=======
                            <a href="{{ url('/request-a-quote') }}" class="waves-effect {{ Request::is('request-a-quote*') ? 'active' : null }}"><i class="md md-content-paste"></i><span> Request a Quote </span></a>
>>>>>>> e29ccdd27609c0470752dbc32f2bca356375a512
                        </li>
                    <?php }; ?>

                    <?php if($userRole == "Customer"){?>
                        <li>
<<<<<<< HEAD
                            <a href="{{ url('dashboard/view-quote-requests') }}" class="waves-effect {{ Request::is('dashboard/view-quote-requests*') ? 'active' : null }}"><i class="md md-my-library-books"></i><span> Quote Requests </span></a>
=======
                            <a href="{{ url('/view-quote-requests') }}" class="waves-effect {{ Request::is('view-quote-requests*') ? 'active' : null }}"><i class="md md-my-library-books"></i><span> Quote Requests </span></a>
>>>>>>> e29ccdd27609c0470752dbc32f2bca356375a512
                        </li>
                    <?php }; ?>
                    
                    <?php if($userRole == "Administrator"){?>
                        <li>
<<<<<<< HEAD
                            <a href="{{ url('dashboard/quote-requests') }}" class="waves-effect {{ Request::is('dashboard/quote-requests*') ? 'active' : null }}"><i class="md md-my-library-books"></i><span> Quote Requests </span></a>
=======
                            <a href="{{ url('/quote-requests') }}" class="waves-effect {{ Request::is('quote-requests*') ? 'active' : null }}"><i class="md md-my-library-books"></i><span> Quote Requests </span></a>
>>>>>>> e29ccdd27609c0470752dbc32f2bca356375a512
                        </li>
                    <?php }; ?>

                    <?php if($userRole == "Administrator"){?>
                        <li>
<<<<<<< HEAD
                            <a href="{{ url('dashboard/invoices') }}" class="disabled waves-effect {{ Request::is('dashboard/invoices*') ? 'active' : null }}"><i class="md md-content-paste"></i><span> Invoices </span></a>
=======
                            <a href="{{ url('/invoices') }}" class="waves-effect {{ Request::is('invoices*') ? 'active' : null }}"><i class="md md-content-paste"></i><span> Invoices </span></a>
>>>>>>> e29ccdd27609c0470752dbc32f2bca356375a512
                        </li>
                    <?php }; ?>
                    
                    <?php if($userRole == "Administrator"){?>
                        <li>
<<<<<<< HEAD
                            <a href="{{ url('dashboard/payments') }}" class="disabled waves-effect {{ Request::is('dashboard/payments*') ? 'active' : null }}"><i class="md md-payment"></i><span> Payments </span></a>
=======
                            <a href="{{ url('/payments') }}" class="waves-effect {{ Request::is('payments*') ? 'active' : null }}"><i class="md md-payment"></i><span> Payments </span></a>
>>>>>>> e29ccdd27609c0470752dbc32f2bca356375a512
                        </li>
                    <?php }; ?>

                    <?php if($userRole == "Administrator"){?>
                        <li>
<<<<<<< HEAD
                            <a href="{{ url('dashboard/statistics') }}" class="disabled waves-effect {{ Request::is('dashboard/statistics*') ? 'active' : null }}"><i class="md md-insert-chart"></i><span> Statistics </span></a>
                        </li>
                    <?php }; ?>
                    
=======
                            <a href="{{ url('/statistics') }}" class="waves-effect {{ Request::is('statistics*') ? 'active' : null }}"><i class="md md-insert-chart"></i><span> Statistics </span></a>
                        </li>
                    <?php }; ?>
                    
                    <?php if($userRole == "Administrator"){?>
                        <li>
                            <a href="{{ url('/about-us') }}" class="waves-effect {{ Request::is('about-us*') ? 'active' : null }}"><i class="md md-info"></i><span> About Us</span></a>
                        </li>
                    <?php }; ?>

>>>>>>> e29ccdd27609c0470752dbc32f2bca356375a512
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <!-- Left Sidebar End -->

    <div class="content-page">
    
    <div class="md-modal md-effect-11" id="modal-11">
        <div class="md-content" style="background-color: #2379CE;">
            
            <div style="color: #fff;">
            <h2 style="color: #fff; text-align: center;">Change User Role</h2>
                <p style="text-align: center;">Click on the user role below to switch.</p>
                
                <div class="row" style="margin-top: 15px; margin-bottom: 20px;">
<<<<<<< HEAD
                    <a href="{{ url('dashboard/users/role/switch/admin') }}"><div class="col-sm-3">
=======
                    <a href="{{ url('/users/role/switch/admin') }}"><div class="col-sm-3">
>>>>>>> e29ccdd27609c0470752dbc32f2bca356375a512
                        <img src="{{asset('images/roles/admin.png')}}">
                        <p style="text-align: center;">Admin</p>
                    </div></a>

<<<<<<< HEAD
                    <a href="{{ url('dashboard/users/role/switch/customer') }}"><div class="col-sm-3">
=======
                    <a href="{{ url('/users/role/switch/customer') }}"><div class="col-sm-3">
>>>>>>> e29ccdd27609c0470752dbc32f2bca356375a512
                        <img src="{{asset('images/roles/customer.png')}}">
                        <p style="text-align: center;">Customer</p>
                    </div></a>

<<<<<<< HEAD
                    <a href="{{ url('dashboard/users/role/switch/event-planner') }}"><div class="col-sm-3">
=======
                    <a href="{{ url('/users/role/switch/event-planner') }}"><div class="col-sm-3">
>>>>>>> e29ccdd27609c0470752dbc32f2bca356375a512
                        <img src="{{asset('images/roles/event-planner.png')}}">
                        <p style="text-align: center;">Event Planner</p>
                    </div></a>

<<<<<<< HEAD
                    <a href="{{ url('dashboard/users/role/switch/team-member') }}"><div class="col-sm-3">
=======
                    <a href="{{ url('/users/role/switch/team-member') }}"><div class="col-sm-3">
>>>>>>> e29ccdd27609c0470752dbc32f2bca356375a512
                        <img src="{{asset('images/roles/team-member.png')}}">
                        <p style="text-align: center;">Team Member</p>
                    </div></a>
                </div>

                <div class="row" style="text-align: center;"><button class="md-close btn-sm btn-success waves-effect waves-light">Close</button></div>
            </div>
        </div>
    </div>


        @yield('content')
        <footer class="footer text-right">
            © 2016 Sri Lanka Institute of Information Technology. All Rights Reserved.<br>
<<<<<<< HEAD
            <strong>Team Members:</strong> <a href="{{ url('dashboard/developers') }}">Gayan</a>, <a href="{{ url('dashboard/developers') }}">Udesh</a>, <a href="{{ url('/developers') }}">Hasitha</a>, <a href="{{ url('/developers') }}">Lasanthi</a>
=======
            <strong>Team Members:</strong> <a href="{{ url('/developers') }}">Gayan</a>, <a href="{{ url('/developers') }}">Udesh</a>, <a href="{{ url('/developers') }}">Hasitha</a>, <a href="{{ url('/developers') }}">Lasanthi</a>
>>>>>>> e29ccdd27609c0470752dbc32f2bca356375a512
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
<script src="{{asset('assets/fastclick/fastclick.js')}}"></script>
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

<<<<<<< HEAD
=======
<!-- Todo -->
<script src="{{asset('js/jquery.todo.js')}}"></script>

>>>>>>> e29ccdd27609c0470752dbc32f2bca356375a512
@yield('footer-js')

<script type="text/javascript">
    /* ==============================================
     Counter Up
     =============================================== */
    jQuery(document).ready(function($) {
        @yield('jquery')
    });



</script>

<!-- Modal-Effect -->
        <script src="{{asset('assets/modal-effect/js/classie.js')}}"></script>
        <script src="{{asset('assets/modal-effect/js/modalEffects.js')}}"></script>


</body>
</html>