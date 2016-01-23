<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
    <meta name="author" content="Coderthemes">

    <link rel="shortcut icon" href="images/favicon_1.ico">

    <title>Plan My Event</title>

    <!-- Base Css Files -->
    <link href="css/bootstrap.min.css" rel="stylesheet" />

    <!-- Font Icons -->
    <link href="assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
    <link href="assets/ionicon/css/ionicons.min.css" rel="stylesheet" />
    <link href="css/material-design-iconic-font.min.css" rel="stylesheet">

    <!--Calendar-->
    <link href="assets/fullcalendar/fullcalendar.css" rel="stylesheet" />

    <!-- animate css -->
    <link href="css/animate.css" rel="stylesheet" />

    <!-- Waves-effect -->
    <link href="css/waves-effect.css" rel="stylesheet">

    <!-- sweet alerts -->
    <link href="assets/sweet-alert/sweet-alert.min.css" rel="stylesheet">

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



<body class="fixed-left">

<!-- Begin page -->
<div id="wrapper">

    <!-- Top Bar Start -->
    <div class="topbar">
        <!-- LOGO -->
        <div class="topbar-left">
            <div class="text-center">
                <a href="index.html" class="logo"><i class="md md-event"></i> <span>PLAN MY EVENT </span></a>
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
                            <a href="" class="dropdown-toggle profile" data-toggle="dropdown" aria-expanded="true"><img src="images/avatar-1.jpg" alt="user-img" class="img-circle"> </a>
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
                    <img src="images/users/avatar-1.jpg" alt="" class="thumb-md img-circle">
                </div>
                <div class="user-info">
                    <div class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Gayan Kalhara <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="javascript:void(0)"><i class="md md-face-unlock"></i> Profile<div class="ripple-wrapper"></div></a></li>
                            <li><a href="javascript:void(0)"><i class="md md-settings"></i> Settings</a></li>
                            <li><a href="javascript:void(0)"><i class="md md-settings-power"></i> Logout</a></li>
                        </ul>
                    </div>

                    <p class="text-muted m-0">Super Admin</p>
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
                        <a href="#" class="waves-effect"><i class="md md-mail"></i><span> Mail </span><span class="pull-right"><i class="md md-add"></i></span></a>
                        <ul class="list-unstyled">
                            <li><a href="{{ url('/mails/new') }}">New Message</a></li>
                            <li><a href="{{ url('/mails/inbox') }}">Inbox</a></li>
                            <li><a href="{{ url('/mails/sent') }}">Sent Items</a></li>
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



                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <!-- Left Sidebar End -->



    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="content-page">
        <!-- Start content -->
        <div class="content">
            <div class="container">

                <!-- Start Widget -->
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-lg-3">
                        <div class="mini-stat clearfix bx-shadow">
                            <span class="mini-stat-icon bg-success"><i class="ion-calendar"></i></span>
                            <div class="mini-stat-info text-right text-muted">
                                <span class="counter">23</span>
                                Events this week
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-lg-3">
                        <div class="mini-stat clearfix bx-shadow">
                            <span class="mini-stat-icon bg-info"><i class="ion-clipboard"></i></span>
                            <div class="mini-stat-info text-right text-muted">
                                <span class="counter">5</span>
                                Quotation Requests
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-sm-6 col-lg-3">
                        <div class="mini-stat clearfix bx-shadow">
                            <span class="mini-stat-icon bg-purple"><i class="ion-email"></i></span>
                            <div class="mini-stat-info text-right text-muted">
                                <span class="counter">12</span>
                                Personal Messages
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-sm-6 col-lg-3">
                        <div class="mini-stat clearfix bx-shadow">
                            <span class="mini-stat-icon bg-pink"><i class="ion-navicon-round"></i></span>
                            <div class="mini-stat-info text-right text-muted">
                                <span class="counter">10</span>
                                Tasks to Do
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End row-->






                <div class="row">
                    <!-- INBOX -->
                    <div class="col-lg-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">Inbox</h4>
                            </div>
                            <div class="panel-body">
                                <div class="inbox-widget nicescroll mx-box">
                                    <a href="#">
                                        <div class="inbox-item">
                                            <div class="inbox-item-img"><img src="images/users/avatar-3.jpg" class="img-circle" alt=""></div>
                                            <p class="inbox-item-author">Udesh Hewagama</p>
                                            <p class="inbox-item-text">I just made a payment for my event. Please confirm if you receive it.</p>
                                            <p class="inbox-item-date">13:17 PM</p>
                                        </div>
                                    </a>
                                    <a href="#">
                                        <div class="inbox-item">
                                            <div class="inbox-item-img"><img src="images/users/avatar-4.jpg" class="img-circle" alt=""></div>
                                            <p class="inbox-item-author">Hasitha Jayasinghe</p>
                                            <p class="inbox-item-text">I requested a quote last week. Haven't received the quotation yet.</p>
                                            <p class="inbox-item-date">12:20 PM</p>
                                        </div>
                                    </a>
                                    <a href="#">
                                        <div class="inbox-item">
                                            <div class="inbox-item-img"><img src="images/users/avatar-5.jpg" class="img-circle" alt=""></div>
                                            <p class="inbox-item-author">Lasanthi Kalpani</p>
                                            <p class="inbox-item-text">Suggest me some good photographers for my wedding.</p>
                                            <p class="inbox-item-date">10:15 AM</p>
                                        </div>
                                    </a>
                                    <a href="#">
                                        <div class="inbox-item">
                                            <div class="inbox-item-img"><img src="images/users/avatar-6.jpg" class="img-circle" alt=""></div>
                                            <p class="inbox-item-author">Buddhika Prasanna</p>
                                            <p class="inbox-item-text">I want to postpone my event I submitted last week.</p>
                                            <p class="inbox-item-date">9:56 AM</p>
                                        </div>
                                    </a>
                                    <a href="#">
                                        <div class="inbox-item">
                                            <div class="inbox-item-img"><img src="images/users/avatar-8.jpg" class="img-circle" alt=""></div>
                                            <p class="inbox-item-author">Dhanushka Udayanga</p>
                                            <p class="inbox-item-text">Can I cancel my event. Plans Changed. Already made the payment.</p>
                                            <p class="inbox-item-date">10:15 AM</p>
                                        </div>
                                    </a>
                                    <a href="#">
                                        <div class="inbox-item">
                                            <div class="inbox-item-img"><img src="images/users/avatar-9.jpg" class="img-circle" alt=""></div>
                                            <p class="inbox-item-author">Sehan Dananjaya</p>
                                            <p class="inbox-item-text">I want a custom event for me. How can I make the order?</p>
                                            <p class="inbox-item-date">9:56 PM</p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div> <!-- end col -->




                    <!-- TODO -->
                    <div class="col-lg-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Todo</h3>
                            </div>
                            <div class="panel-body todoapp">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <h4 id="todo-message"><span id="todo-remaining"></span> of <span id="todo-total"></span> remaining</h4>
                                    </div>
                                    <div class="col-sm-6">
                                        <a href="" class="pull-right btn btn-success btn-sm waves-effect waves-light" id="btn-archive">Archive</a>
                                    </div>
                                </div>

                                <ul class="list-group no-margn nicescroll todo-list" style="max-height: 288px;" id="todo-list"></ul>

                                <form name="todo-form" id="todo-form" role="form" class="m-t-20">
                                    <div class="row">
                                        <div class="col-sm-9 todo-inputbar">
                                            <input type="text" id="todo-input-text" name="todo-input-text" class="form-control" placeholder="Add new todo">
                                        </div>
                                        <div class="col-sm-3 todo-send">
                                            <button class="btn-success btn-block btn waves-effect waves-light" type="button" id="todo-btn-submit">Add</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div> <!-- end col -->

                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div id="calendar"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- end row -->

            </div> <!-- container -->

        </div> <!-- content -->

        <footer class="footer text-right">
            © 2016 Sri Lanka Institute of Information Technology. All Rights Reserved.<br>3rd Year - 1st Semester Software Engineering Project, Team Members: Gayan, Udesh, Hasitha, Lasanthi
        </footer>

    </div>
    <!-- ============================================================== -->
    <!-- End Right content here -->
    <!-- ============================================================== -->

</div>
<!-- END wrapper -->



<script>
    var resizefunc = [];
</script>

<!-- jQuery  -->
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/waves.js"></script>
<script src="js/wow.min.js"></script>
<script src="js/jquery.nicescroll.js" type="text/javascript"></script>
<script src="js/jquery.scrollTo.min.js"></script>
<script src="assets/chat/moment-2.2.1.js"></script>
<script src="assets/jquery-sparkline/jquery.sparkline.min.js"></script>
<script src="assets/jquery-detectmobile/detect.js"></script>
<script src="assets/fastclick/fastclick.js"></script>
<script src="assets/jquery-slimscroll/jquery.slimscroll.js"></script>
<script src="assets/jquery-blockui/jquery.blockUI.js"></script>

<!-- sweet alerts -->
<script src="assets/sweet-alert/sweet-alert.min.js"></script>
<script src="assets/sweet-alert/sweet-alert.init.js"></script>

<!-- flot Chart -->
<script src="assets/flot-chart/jquery.flot.js"></script>
<script src="assets/flot-chart/jquery.flot.time.js"></script>
<script src="assets/flot-chart/jquery.flot.tooltip.min.js"></script>
<script src="assets/flot-chart/jquery.flot.resize.js"></script>
<script src="assets/flot-chart/jquery.flot.pie.js"></script>
<script src="assets/flot-chart/jquery.flot.selection.js"></script>
<script src="assets/flot-chart/jquery.flot.stack.js"></script>
<script src="assets/flot-chart/jquery.flot.crosshair.js"></script>

<!-- Calendar -->
<script src='assets/fullcalendar/moment.min.js'></script>
<script src='assets/fullcalendar/fullcalendar.min.js'></script>
<script src="assets/fullcalendar/fullcalendar.js"></script>

<!-- Counter-up -->
<script src="assets/counterup/waypoints.min.js" type="text/javascript"></script>
<script src="assets/counterup/jquery.counterup.min.js" type="text/javascript"></script>

<!-- CUSTOM JS -->
<script src="js/jquery.app.js"></script>

<!-- Dashboard -->
<script src="js/jquery.dashboard.js"></script>

<!-- Chat -->
<script src="js/jquery.chat.js"></script>

<!-- Todo -->
<script src="js/jquery.todo.js"></script>

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
    });
</script>

</body>
</html>