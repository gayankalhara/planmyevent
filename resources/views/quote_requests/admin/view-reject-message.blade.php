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
                    <center><h3 class="page-title">Quote Rejected Reason</h3></center>
                </div>
            </div>
            <br/>
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="form">
                                <form class="form-horizontal" id="" method="post" action="" >
                                    <div class="form-group ">
                                        <label for="firstname" class="control-label col-lg-3">Quote ID</label>
                                        <div class="col-lg-9">
                                            <input class=" form-control" id="eventid" name="eventid" type="text" value="@foreach( $result as $quote){{$quote->QuoteID}}
                                            @endforeach" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="firstname" class="control-label col-lg-3">Reason</label>
                                        <div class="col-lg-9">
                                            <input class=" form-control" id="firstname" name="firstname" type="text" value="@foreach( $result as $quote){{$quote->Reason}}
                                            @endforeach" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="objective" class="control-label col-lg-3">Message</label>
                                        <div class="col-lg-9">
                                            <textarea class="form-control" id="objective" name="objective" rows="5" readonly>@foreach( $result as $quote){{$quote->Message}}
                                                @endforeach</textarea>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="firstname" class="control-label col-lg-3">Rejected Date</label>
                                        <div class="col-lg-9">
                                            <input class=" form-control" id="firstname" name="firstname" type="text" value="@foreach( $result as $quote){{$quote->RejectedDate}}
                                            @endforeach" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <div class="col-lg-offset-5 col-lg-4">
                                            <a href="view-rejected?id=@foreach( $result as $quote){{$quote->QuoteID}}
                                            @endforeach"><button class="btn btn-default waves-effect" type="button">Go Back</button></a>
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