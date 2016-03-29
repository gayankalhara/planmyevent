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
                    <center><h3 class="page-title">Add Quote</h3></center>
                </div>
            </div>
            <br/>

            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <label>Quote ID:</label>
                            <label>{{$approvedQuote->QuoteID}}</label>
                            <br/>
                            <label>Event Type:</label>
                            <label>{{$approvedQuote->EventType}}</label>
                            <br/>
                            <label>Services:</label>
                            <label>{{implode(', ', $services)}}</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8 col-md-offset-2">

                    <div class="panel panel-default">
                        <div class="panel-body" id="addForm">
                            <h4>Quote Details</h4>
                            <div class="col-md-10 col-md-offset-1">

                                <br/>
                                <form class="form-horizontal" id="" method="post" action="pay" >
                                    <div>

                                        <?php
                                        for ($i=1; $i <=$serviceCount; $i++)

                                        {
                                            echo '<div class="form-group ">
                                  <label for="" class="control-label col-lg-4">'.$services[$i-1].' (Rs.)</label>
                                  <div class="col-lg-6">
                                  <input style="text-align: right;" class=" form-control" id="" name="" type="text" value="'.$cost[$i-1].'" readonly>
                              </div>
                                        </div>';

                                        }

                                        ?>
                                        <hr>

                                        <div class="form-group ">
                                            <label for="firstname" class="control-label col-lg-4">Sub Total (Rs.)</label>
                                            <div class="col-lg-6">
                                                <input style="text-align: right;" class=" form-control" id="" name="" type="text" value="{{$approvedQuote->SubTotal}}" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group ">
                                            <label for="firstname" class="control-label col-lg-4">Down Payment 40% (Rs.)</label>
                                            <div class="col-lg-6">
                                                <input style="text-align: right;" class=" form-control" id="downpayment" name="downpayment" value="{{$approvedQuote->DownPayment}}" type="text" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group ">
                                            <label for="firstname" class="control-label col-lg-4">Total Payable (Rs.)</label>
                                            <div class="col-lg-6">
                                                <input style="text-align: right;" class=" form-control" id="" name="" value="{{$approvedQuote->TotalCost}}" type="text" readonly>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="form-group ">
                                            <label for="remarks" class="control-label col-lg-4">Remarks</label>
                                            <div class="col-lg-6">
                                                <textarea class="form-control" id="remarks" name="remarks" rows="5" readonly>{{$approvedQuote->Remarks}}</textarea>
                                            </div>
                                        </div>
                                        <hr>
                                            <input class=" form-control" id="quoteid" name="quoteid" value="{{$approvedQuote->QuoteID}}" type="hidden" readonly>
                                            <input class=" form-control" id="eventType" name="eventType" value="{{$approvedQuote->EventType}}" type="hidden" readonly>
                                        <div class="form-group ">
                                            <div class="col-lg-offset-3 col-lg-9">
                                                <button class="btn btn-success waves-effect waves-light" type="submit">Proceed to Payment</button>
                                                <a href="/view-quote-requests/approved-quotes?id={{$approvedQuote->QuoteID}}"><button class="btn btn-default waves-effect" type="button">Go Back</button></a>
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
            {{--@if ($message == 'success')--}}

                {{--swal({--}}
                        {{--title: 'Success',--}}
                        {{--text: 'Quote added successfully',--}}
                        {{--type: 'success',--}}
                        {{--showCancelButton: true,--}}
                        {{--showConfirmButton: true,--}}
                        {{--cancelButtonText: 'Cancel',--}}
                        {{--confirmButtonText: 'View'--}}
                    {{--},--}}

                    {{--function(isConfirm){--}}
                        {{--if (isConfirm) {--}}
                            {{--//window.location.href = "http://www.planmyevent.me/view-quote-requests";--}}
                        {{--}--}}
                    {{--});--}}

            {{--@elseif ($message == 'fail')--}}

                {{--swal({--}}
                {{--title: 'Fail',--}}
                {{--text: 'Quote submission failed',--}}
                {{--type: 'error',--}}
                {{--showConfirmButton: false,--}}
                {{--showCancelButton: true,--}}
                {{--cancelButtonText: 'Cancel'--}}
            {{--});--}}

            {{--@endif--}}
    });
    </script>


@endsection