{{-- Home Page --}}

@extends('master')

@section('content')
<div class="content">
    <div class="container">
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
                        <h3 class="panel-title">Things you have to do</h3>
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
        </div> <!-- end row -->

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
    </div>
</div> <!-- content -->

@endsection


@section('jquery')
    $('.counter').counterUp({
            delay: 100,
            time: 1200
        });

        $('#calendar').fullCalendar( 'changeView', 'agendaWeek');
@endsection

@section('footer-js')
<!-- Todo -->
<script src="{{asset('js/jquery.todo.js')}}"></script>
@endsection