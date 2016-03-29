@extends('master')

        <!-- Header CSS -->
@section('header-css')

@endsection

        <!-- Header JavaScript -->
@section('header-js')

@endsection

@section('content')
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <center><h3 class="page-title">Approved Quote Requests</h3></center>
                </div>
            </div>
            <br/>
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <h4>CUSTOMER DETAILS</h4>
                            <br/>
                            <div class="form">
                                <form class="form-horizontal" id="" method="post" action="quote-payment" >
                                    <div class="form-group ">
                                        <label for="firstname" class="control-label col-lg-3">Event ID</label>
                                        <div class="col-lg-9">
                                            <input class=" form-control" id="eventid" name="eventid" type="text" value="@foreach( $result as $quote){{$quote->QuoteID}}
                                            @endforeach" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="firstname" class="control-label col-lg-3">Firstname</label>
                                        <div class="col-lg-9">
                                            <input class=" form-control" id="firstname" name="firstname" type="text" value="@foreach( $result as $quote){{$quote->FirstName}}
                                            @endforeach" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="lastname" class="control-label col-lg-3">Lastname</label>
                                        <div class="col-lg-9">
                                            <input class=" form-control" id="lastname" name="lastname" type="text" value="@foreach( $result as $quote){{$quote->LastName}}
                                            @endforeach" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="address" class="control-label col-lg-3">Address</label>
                                        <div class="col-lg-9">
                                            <input class="form-control " id="address" name="address" type="text" value="@foreach( $result as $quote){{$quote->Address}}
                                            @endforeach" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="city" class="control-label col-lg-3">City</label>
                                        <div class="col-lg-4">
                                            <input class="form-control " id="city" name="city" type="text" value="@foreach( $result as $quote){{$quote->City}}
                                            @endforeach" readonly>
                                        </div>
                                        <label for="zip" class="control-label col-lg-2">Zip</label>
                                        <div class="col-lg-3">
                                            <input class="form-control " id="zip" name="zip" type="text"
                                                   value="@foreach( $result as $quote){{$quote->Zip}}
                                                   @endforeach" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="email" class="control-label col-lg-3">Email</label>
                                        <div class="col-lg-9">
                                            <input class="form-control " id="email" name="email" type="text" value="@foreach( $result as $quote){{$quote->Email}}
                                            @endforeach" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="phone" class="control-label col-lg-3">Phone</label>
                                        <div class="col-lg-9">
                                            <input class="form-control " id="phone" name="phone" type="text" value="@foreach( $result as $quote){{$quote->Phone}}
                                            @endforeach" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="contact" class="control-label col-lg-3">Contact via</label>
                                        <div class="col-lg-9">
                                            <input class="form-control" type="text" name="" value="@foreach( $result as $quote){{$quote->Contact_Via}}
                                            @endforeach" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="eventType" class="control-label col-lg-3">Event Type</label>
                                        <div class="col-lg-9">
                                            <input class="form-control" type="text" name="eventType" value="@foreach( $result as $quote){{$quote->EventType}}
                                            @endforeach" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group " id="divTask">
                                        <label for="task" class="control-label col-lg-3">Task</label>
                                        <div class="col-lg-9">
                                            <input class="form-control" type="text" id="task" name="task" value="{{$services}}" readonly>
                                        </div>
                                    </div>
                                    <br/>
                                    <h4>EVENT DETAILS</h4>
                                    <br/>
                                    <div class="form-group ">
                                        <label for="guests" class="control-label col-lg-3">No. of guests</label>
                                        <div class="col-lg-9">
                                            <input class="form-control " id="guests" name="guests" type="text" value="@foreach( $result as $quote){{$quote->Guests}}
                                            @endforeach" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="eventdate" class="control-label col-lg-3">Event Date</label>
                                        <div class="col-lg-9">
                                            <input class="form-control " id="eventdate" name="eventdate" type="text"value="@foreach( $result as $quote){{$quote->EventDate}}
                                            @endforeach" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="eventdays" class="control-label col-lg-3">No. of event days</label>
                                        <div class="col-lg-9">
                                            <input class="form-control " id="eventdays" name="eventdays" type="text" value="@foreach( $result as $quote){{$quote->NoOfDays}}
                                            @endforeach" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="eventtime" class="control-label col-lg-3">Event Time</label>
                                        <div class="col-lg-9">
                                            <input id="eventtime" name="eventtime" type="text" class="form-control" value="@foreach( $result as $quote){{$quote->EventTime}}
                                            @endforeach" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="objective" class="control-label col-lg-3">Objective of the event</label>
                                        <div class="col-lg-9">
                                            <textarea class="form-control" id="objective" name="objective" rows="5" readonly>@foreach( $result as $quote){{$quote->Objective}}
                                                @endforeach</textarea>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="" class="control-label col-lg-3">Event Meant for</label>
                                        <div class="col-lg-9">
                                            <input class="form-control" type="text" name="" value="@foreach( $result as $quote){{$quote->EventFor}}
                                            @endforeach" readonly>
                                        </div>
                                    </div>
                                    <br/>

                                    <input class="form-control " id="serviceCount" name="serviceCount" type="hidden" value="@foreach( $result as $quote){{$quote->ServiceCount}}
                                    @endforeach" >

                                    <div class="form-group ">
                                        <div class="col-lg-offset-4 col-lg-5">
                                            <button class="btn btn-success waves-effect waves-light" type="submit">View Payment Details</button>
                                            <a href="/view-quote-requests"><button class="btn btn-default waves-effect" type="button">Go Back</button></a>
                                        </div>
                                    </div>
                                    {!! csrf_field() !!}
                                </form><!-- .form -->
                            </div>
                        </div>
                    </div>
                </div>

            </div> <!-- End row -->
        </div>
    </div>

    @endsection

            <!-- Footer JavaScript -->
@section('footer-js')

@endsection