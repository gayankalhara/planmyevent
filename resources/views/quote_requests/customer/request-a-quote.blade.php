@extends('master')

@section('header-js')

@endsection

@section('header-css')
    <link href="{{asset('assets/timepicker/bootstrap-timepicker.min.css')}}" rel="stylesheet" />

    <style>
        #spinner{
            line-height: 1.75em;
        }
    </style>
@endsection

@section('content')

    <div class="content">
        <div class="container">
            <br/>
            <div class="row">
                <div class="col-md-8 col-md-offset-1">
                    <div class="panel panel-default panel-border"> 
                        <div class="col-md-12">
                        <br/>
                        <center><h1>Request a Quote</h1></center>
                        <br/>
                        </div>
                        <div class="panel-body">   
                        <h4>CUSTOMER DETAILS</h4> 
                        <br/>
                            <div class="form">
                                <form class="form-horizontal" id="" method="post" action="request-a-quote/addquote" >
                                    <div class="form-group ">
                                        <label for="firstname" class="control-label col-lg-3">Firstname *</label>
                                        <div class="col-lg-9">
                                            <input class=" form-control" id="firstname" name="firstname" type="text" value="{{$fullname[0]}}" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="lastname" class="control-label col-lg-3">Lastname *</label>
                                        <div class="col-lg-9">
                                            <input class=" form-control" id="lastname" name="lastname" type="text" value="{{$fullname[1]}}" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="address" class="control-label col-lg-3">Address *</label>
                                        <div class="col-lg-9">
                                            <input class="form-control " id="address" name="address" type="text" value="{{$address}}" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="city" class="control-label col-lg-3">City *</label>
                                        <div class="col-lg-4">
                                            <input class="form-control " id="city" name="city" type="text" value="{{$city}}" readonly>
                                        </div>
                                        <label for="zip" class="control-label col-lg-1">Zip</label>
                                        <div class="col-lg-4">
                                            <input class="form-control " id="zip" name="zip" type="text" value="{{$zip}}" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="email" class="control-label col-lg-3">Email *</label>
                                        <div class="col-lg-9">
                                            <input class="form-control " id="email" name="email" type="email" value="{{$email}}" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="phone" class="control-label col-lg-3">Phone *</label>
                                        <div class="col-lg-9">
                                            <input class="form-control " id="phone" name="phone" type="text" value="{{$phone}}" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="contact" class="control-label col-lg-3">Contact via *</label>
                                        <div class="col-lg-9">
                                        <div class="radio radio-info">
                                            <div class="col-md-3">
                                            <input class="form-control " id="contact" name="contact" type="radio" value="Phone" required @if(old('contact')=="Phone") {{'checked'}} @endif>
                                            <label for="contact">Phone</label>
                                            </div>
                                            <div class="col-md-3">
                                            <input class="form-control " id="contact" name="contact" type="radio" value="Email" required @if(old('contact')=="Email") {{'checked'}} @endif>
                                            <label for="contact">Email</label>
                                            </div>
                                        </div>
                                        </div>
                                        @if ($errors->has('contact'))
                                            <div class="col-lg-9 col-lg-offset-3">
                                                <div class="alert alert-danger"  style="margin-bottom:0; margin-top:5px; padding:6px;">{{$errors->first('contact')}}</div>
                                            </div>
                                        @endif
                                    </div>
                                    <br/>
                                    <hr>
                                    <h4>EVENT DETAILS</h4> 
                                    <br/>
                                    <div class="form-group ">
                                        <label for="eventType" class="control-label col-lg-3">Event Type *</label>
                                        <div class="col-md-8">
                                            <select class="form-control" name="eventType" id="eventType" required>
                                                <option value="">Select an Event Type</option>
                                                @foreach($eventType as $item)
                                                    <option value="{{$item->EventName}}">{{$item->EventName}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <span id="spin" hidden><i id="spinner" class="fa fa-circle-o-notch fa-spin fa-lg"></i></span>
                                        @if ($errors->has('eventType'))
                                            <div class="col-lg-9 col-lg-offset-3">
                                                <div class="alert alert-danger"  style="margin-bottom:0; margin-top:5px; padding:6px;">{{$errors->first('eventType')}}</div>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="form-group " id="divTask" hidden>
                                        <label for="task" class="control-label col-lg-3">Task *</label>
                                        <div class="col-md-8">
                                            <select multiple class="form-control" name="task[]" id="task" required>
                                            </select>
                                            <p>Press Control to select multiple tasks</p>
                                        </div>
                                        @if ($errors->has('task'))
                                            <div class="col-lg-9 col-lg-offset-3">
                                                <div class="alert alert-danger"  style="margin-bottom:0; margin-top:5px; padding:6px;">{{$errors->first('task')}}</div>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="form-group ">
                                        <label for="guests" class="control-label col-lg-3">No. of guests *</label>
                                        <div class="col-lg-9">
                                            <input class="form-control " id="guests" name="guests" type="number" min="1" value="{{old('guests')}}" required>
                                        </div>
                                        @if ($errors->has('guests'))
                                            <div class="col-lg-9 col-lg-offset-3">
                                                <div class="alert alert-danger"  style="margin-bottom:0; margin-top:5px; padding:6px;">{{$errors->first('guests')}}</div>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="form-group ">
                                        <label for="eventdate" class="control-label col-lg-3">Event Date *</label>
                                        <div class="col-lg-9">
                                            <input class="form-control " id="eventdate" name="eventdate" type="date" value="{{old('eventdate')}}" required>
                                        </div>
                                        @if ($errors->has('eventdate'))
                                            <div class="col-lg-9 col-lg-offset-3">
                                                <div class="alert alert-danger"  style="margin-bottom:0; margin-top:5px; padding:6px;">{{$errors->first('eventdate')}}</div>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="form-group ">
                                        <label for="eventdays" class="control-label col-lg-3">No. of event days *</label>
                                        <div class="col-lg-9">
                                            <input class="form-control " id="eventdays" name="eventdays" type="number" min="1" value="{{old('eventdays')}}" required>
                                        </div>
                                        @if ($errors->has('eventdays'))
                                            <div class="col-lg-9 col-lg-offset-3">
                                                <div class="alert alert-danger"  style="margin-bottom:0; margin-top:5px; padding:6px;">{{$errors->first('eventdays')}}</div>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="form-group ">
                                        <label for="eventtime" class="control-label col-lg-3">Event Time *</label>
                                        <div class="col-lg-9">
                                            <div class="input-group bootstrap-timepicker timepicker">
                                                <input id="eventtime" name="eventtime" type="text" class="form-control"  data-minute-step="1" data-template="false" data-modal-backdrop="true" required>
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
                                            </div>
                                        </div>
                                        @if ($errors->has('eventtime'))
                                            <div class="col-lg-9 col-lg-offset-3">
                                                <div class="alert alert-danger"  style="margin-bottom:0; margin-top:5px; padding:6px;">{{$errors->first('eventtime')}}</div>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="form-group ">
                                        <label for="objective" class="control-label col-lg-3">Objective of the event</label>
                                        <div class="col-lg-9">
                                            <textarea class="form-control" id="objective" name="objective" rows="5" placeholder="Explain the objective of your event in detail" required>{{old('objective')}}</textarea>
                                        </div>
                                        @if ($errors->has('objective'))
                                            <div class="col-lg-9 col-lg-offset-3">
                                                <div class="alert alert-danger"  style="margin-bottom:0; margin-top:5px; padding:6px;">{{$errors->first('objective')}}</div>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="form-group ">
                                        <label for="" class="control-label col-lg-3">Event Meant for *</label>
                                        <div class="col-lg-3">
                                        <div class="checkbox checkbox-primary">
                                            <div class="col-md-12">
                                            <input class="form-control " id="guesttype" name="guesttype[]" type="checkbox" value="Adult" @if(old('guesttype')=="Adult") {{'checked'}} @endif>
                                            <label for="">Adult</label>
                                            </div>
                                            <div class="col-md-12">
                                            <input class="form-control " id="guesttype" name="guesttype[]" type="checkbox" value="Children" @if(old('guesttype')=="Children") {{'checked'}} @endif>
                                            <label for="">Children</label>
                                            </div>
                                            <div class="col-md-12">
                                            <input class="form-control " id="guesttype" name="guesttype[]" type="checkbox" value="Senior Citizen" @if(old('guesttype')=="Senior Citizen") {{'checked'}} @endif>
                                            <label for="">Senior Citizen</label>
                                            </div>
                                        </div>
                                        </div>
                                        @if ($errors->has('guesttype'))
                                            <div class="col-lg-9 col-lg-offset-3">
                                                <div class="alert alert-danger"  style="margin-bottom:0; margin-top:5px; padding:6px;">{{$errors->first('guesttype')}}</div>
                                            </div>
                                        @endif
                                    </div>
                                    <br/>
                                    <hr>
                                    <div class="form-group ">
                                        <div class="col-lg-offset-3 col-lg-9">
                                            <button class="btn btn-success waves-effect waves-light" type="submit">Save & Continue</button>
                                            <button class="btn btn-default waves-effect" type="reset">Reset</button>
                                            <button class="btn btn-default waves-effect" id="demo" name="demo" type="button">Demo</button>
                                        </div>
                                    </div>
                                {!! csrf_field() !!}
                                </form><!-- .form -->
                            </div>
                        </div>
                    </div> 
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer-js')

    <script type="text/javascript">

        $(document).ready(function(){

            $('#eventtime').timepicker();

            var d = new Date();

            var month = d.getMonth().toString();

            var day = d.getDate().toString();

            if(month.length <2){
                month = '0' + (d.getMonth()+1).toString();
            }

            if(day.length <2){
                day = '0' + day;
            }

            var date = d.getFullYear().toString() + '-' + month + '-' + day;

            $('#eventdate').attr('min' , date);

            $('#eventType').change(function(){

                var event = $('#eventType').val();

                $.ajaxSetup(
                        {
                            headers:
                            {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });

                $.ajax({



                    type: "POST",
                    url: "{{ url('dashboard/request-a-quote/task') }}",
                    data: {event: event, '_token': '{!! csrf_token() !!}'},
                    cache: false,
                    beforeSend: function(){
                        $('#spin').show();
                    },
                    success: function(data) {

                        $('#spin').hide();
                        $('#divTask').show();
                        var task = $('#task');
                        task.empty();
                        $.each(data, function(i, element) {
                            task.append($("<option></option>")
                            .attr("value", element.Service).text(element.Service));
                        });

                    },
                    error: function(data){

                        swal({
                            title: 'Error',
                            text: 'Unable to get the Services',
                            type: 'error',
                            showCancelButton: true,
                            showConfirmButton: false,
                            cancelButtonText: 'Cancel'
                        });
                        
                    }
                });
            });
            

            //view successful/fail message on submission of the request-a-quote form
            @if (session('message') == 'success')

                swal({
                            title: 'Success',
                            text: 'Quote Request submitted successfully',
                            type: 'success',
                            showCancelButton: true,
                            showConfirmButton: true,
                            cancelButtonText: 'Cancel',
                            confirmButtonText: 'View'
                },

                function(isConfirm){
                    if (isConfirm) {
                        window.location.href = "{{ url('dashboard/view-quote-requests') }}";
                    }
                });

            @elseif (session('message') == 'fail')

                swal({
                            title: 'Fail',
                            text: 'Quote Request submission failed',
                            type: 'error',
                            showConfirmButton: false,
                            showCancelButton: true,
                            cancelButtonText: 'Cancel'
                });

            @endif

        });

    </script>

    <script type="text/javascript">

        $("#demo").click(function(){


            $("#contact[value='Email']").prop('checked',true);
            $("#guests").val("20");
            $("#eventdate").val("2016-05-12");
            $("#eventdays").val("1");
            $("#objective").val("Objective");
            $("#guesttype[value='Adult']").prop('checked',true);
            $("#guesttype[value='Children']").prop('checked',true);

        });

    </script>

    <!-- Date Time Picker -->
    <script src="{{asset('assets/timepicker/bootstrap-timepicker.min.js')}}"></script>
    <script src="{{asset('assets/timepicker/bootstrap-datepicker.js')}}"></script>


@endsection


@section('jquery')
        
@endsection




