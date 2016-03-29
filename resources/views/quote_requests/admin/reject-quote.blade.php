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
                    <center><h3 class="page-title">Reject Quote</h3></center>
                </div>
            </div>
            <br/>

            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <label>Quote ID:</label>
                            <label>{{$eventID}}</label>
                            <br/>
                            <label>Event Type:</label>
                            <label>@foreach( $quoteDetails as $key){{$key->EventType}}
                                @endforeach</label>
                            <br/>
                            <label>Services:</label>
                            <label id="tasklist">{{$services}}</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8 col-md-offset-2">

                    <div class="panel panel-default">
                        <div class="panel-body" id="addForm">
                            <h4>Rejection Details</h4>
                            <div class="col-md-10 col-md-offset-1">

                                <br/>
                                <form class="form-horizontal" id="" method="post" action="send-reject-quote" >
                                    <div>
                                        <div class="form-group ">
                                            <label for="selectReason" class="control-label col-lg-12" style="text-align: left;">Select Reason *</label>
                                            <div class="col-lg-12">
                                                <select class="form-control" name="selectReason" id="selectReason" required>
                                                    <option value="">Pick a rejection Reason</option>
                                                    <option value="Event Date is already taken">Event Date is already taken</option>
                                                    <option value="No services available">No services available</option>
                                                    <option value="Venue is reserved">Venue is reserved</option>
                                                </select>
                                            </div>
                                        </div>
                                        <br/>
                                        <div class="form-group ">
                                            <label for="rejectMessage" class="control-label col-lg-12" style="text-align: left;">Let customer know why you want to reject: *</label>
                                            <div class="col-lg-12">
                                                <textarea class="form-control" id="rejectMessage" name="rejectMessage" rows="7" placeholder="Type your message here ..." required></textarea>
                                            </div>
                                        </div>
                                        <input type="text" id="eventid" name="eventid" value="{{$eventID}}" hidden>
                                        <div class="form-group ">
                                            <div class="col-lg-offset-4 col-lg-8">
                                                <button class="btn btn-danger waves-effect waves-light" type="submit">Reject Quote</button>
                                                <button class="btn btn-default waves-effect" type="reset">Reset</button>
                                            </div>
                                        </div>
                                    </div>
                                    {!! csrf_field() !!}
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection

            <!-- Footer JavaScript -->
@section('footer-js')
    <script type="text/javascript">
        $(document).ready(function() {

            //view successful/fail message on submission of the add-quote form
            @if ($message == 'success')

                swal({
                        title: 'Success',
                        text: 'Quote rejected successfully',
                        type: 'success',
                        showConfirmButton: true,
                        confirmButtonText: 'View'
                    },

                    function(isConfirm){
                        if (isConfirm) {
                            window.location.href = "http://www.planmyevent.me/quote-requests";
                        }
                    });

            @elseif ($message == 'fail')

                swal({
                title: 'Fail',
                text: 'Quote rejection failed',
                type: 'error',
                showConfirmButton: false,
                showCancelButton: true,
                cancelButtonText: 'Cancel'
            });

            @endif
    });
    </script>


@endsection