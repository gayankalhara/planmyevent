{{-- Home Page --}}

@extends('master')

@section('meta')
<meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection

@section('content')
<div class="content">
    <div class="container">

        <!-- WEATHER -->
        <div class="row">
                    
            <div class="col-lg-6">
                
                <!-- BEGIN WEATHER WIDGET 1 -->
                <div class="panel bg-info" style="height: 161px;">
                    <div class="panel-body">
                    
                        <div class="row">
                            <div class="col-sm-3" style="margin-left: 18px;">
                                <div class="row">
                                    <img src="{{ asset('images/male.png') }}">
                                </div>
                            </div>
                            <div class="col-sm-7" style="margin-left: 10px;">
                                <div class="row">
                                    <h2 style="margin-top: 20px;" class="m-t-0 text-white">Welcome</h2>
                                    <h1 class="m-t-0 text-white">{{ Auth::User()->name }}</h1>
                                </div>
                            </div>
                        </div><!-- end row -->
                    </div><!-- panel-body -->
                </div><!-- panel-->
                <!-- END Weather WIDGET 1 -->
                
            </div><!-- End col-md-6 -->

            <div class="col-lg-6">
                
                <!-- WEATHER WIDGET 2 -->
                <div class="panel bg-success">
                    <div class="panel-body">
                    
                        <div class="row">
                            <div class="col-sm-7">
                                <div class="">
                                    <div class="row">
                                        <div class="col-xs-6 text-center">
                                            <canvas id="snow" width="115" height="115"></canvas>
                                        </div>
                                        <div class="col-xs-6">
                                            <h2 class="m-t-0 text-white"><b> 23°</b></h2>
                                            <p class="text-white">Partly cloudy</p>
                                            <p class="text-white">15km/h - 37%</p>
                                        </div>
                                    </div><!-- end row -->
                                </div><!-- weather-widget -->
                            </div>
                            <div class="col-sm-5">
                                <div class="row">
                                    <div class="col-xs-4 text-center">
                                        <h4 class="text-white m-t-0">SAT</h4>
                                        <canvas id="sleet" width="35" height="35"></canvas>
                                        <h4 class="text-white">30<i class="wi-degrees"></i></h4>
                                    </div>
                                    <div class="col-xs-4 text-center">
                                        <h4 class="text-white m-t-0">SUN</h4>
                                        <canvas id="fog" width="35" height="35"></canvas>
                                        <h4 class="text-white">28<i class="wi-degrees"></i></h4>
                                    </div>
                                    <div class="col-xs-4 text-center">
                                        <h4 class="text-white m-t-0">MON</h4>
                                        <canvas id="partly-cloudy-night" width="35" height="35"></canvas>
                                        <h4 class="text-white">33<i class="wi-degrees"></i></h4>
                                    </div>
                                </div><!-- End row -->
                            </div> <!-- col-->
                        </div><!-- End row -->
                    </div><!-- panel-body -->
                </div><!-- panel -->
                <!-- END WEATHER WIDGET 2 -->
                    
            </div><!-- /.col-md-6 -->
        </div> <!-- End row -->   

        @if($userRole == "Administrator")
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
                        <span class="counter">{{ $todoCount }}</span>
                        Tasks to Do
                    </div>
                </div>
            </div>
        </div>
        <!-- End row-->
        @endif

        <div class="row">
            <!-- INBOX -->
            <div class="col-lg-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">Your Incoming Messages</h4>
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

                            <a href="#">
                                <div class="inbox-item">
                                    <div class="inbox-item-img"><img src="images/users/avatar-5.jpg" class="img-circle" alt=""></div>
                                    <p class="inbox-item-author">Lasanthi Kalpani</p>
                                    <p class="inbox-item-text">Suggest me some good photographers for my wedding.</p>
                                    <p class="inbox-item-date">10:15 AM</p>
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
                        <h3 class="panel-title">Things you have to do</h3>
                    </div>
                    <div class="panel-body todoapp">
                        <div class="row">
                            <div class="col-sm-5">
                                <h4 id="todo-message"><span id="todo-remaining"></span> of <span id="todo-total"></span> remaining</h4>
                            </div>
                            <div class="col-sm-7">
                                <a href="{{ url('dashboard/todo') }}" class="pull-right btn-sm btn btn-icon waves-effect waves-light btn-purple m-b-5"> <i class="fa fa-table"></i> </a>

                                <a href="{{ url('dashboard/todo') }}" class="pull-right btn-sm btn btn-icon waves-effect waves-light btn-primary m-b-5" id="btn-todo-mail"> <i class="fa fa-envelope"></i> </a>

                                <button type="button" class="pull-right btn-sm btn btn-success waves-effect waves-light m-b-5" id="btn-archive"> <i class="fa fa-save"></i> <span>Archive</span> </button>

                                <button type="button" class="pull-right btn-sm btn btn-warning waves-effect waves-light m-b-5" id="todo-delAll"> <i class="fa fa-trash"></i> <span>Delete All</span> </button>


                            </div>
                        </div>

                        <ul class="list-group no-margn nicescroll todo-list" style="max-height: 288px;" id="todo-list"></ul>

                        <form name="todo-form" id="todo-form" role="form" class="m-t-20">
                            <div class="row">
                                <div class="col-sm-9 todo-inputbar">
                                    <input type="text" id="todo-input-text" name="todo-input-text" class="form-control" placeholder="Add new todo">
                                </div>
                                <div class="col-sm-3 todo-send">
                                    <button type="button" class="btn btn-info waves-effect waves-light m-b-5" id="todo-btn-submit"> <i class="fa fa-check"></i> <span>Add to List</span> </button>                                   
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div> <!-- end col -->   
        </div> <!-- end row -->
        
        @if($userRole == "Administrator")
        <div class="row">
            <!-- Calendar -->
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
        </div>
        @endif
    </div>
</div> <!-- content -->

@endsection

@section('jquery')
    $('.counter').counterUp({
        delay: 100,
        time: 1200
    });

    //$('#calendar').fullCalendar( 'changeView', 'agendaWeek');  
@endsection

@section('footer-js')
 <!-- skycons -->
<script src="{{asset('js/skycons.min.js')}}" type="text/javascript"></script>
<script src="{{asset('js/jquery.todo.js')}}"></script>
<script>
/* BEGIN SVG WEATHER ICON */
if (typeof Skycons !== 'undefined'){
var icons = new Skycons(
    {"color": "#fff"},
    {"resizeClear": true}
    ),
        list  = [
            "clear-day", "clear-night", "partly-cloudy-day",
            "partly-cloudy-night", "cloudy", "rain", "sleet", "snow", "wind",
            "fog"
        ],
        i;

    for(i = list.length; i--; )
    icons.set(list[i], list[i]);
    icons.play();
};
</script>
@endsection