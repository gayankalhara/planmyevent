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

        <center><div class="md-modal md-effect-11" id="data-modal-add">
            <div class="md-content" <?php if(Session::get('message')=='Quote Submit Failed') {echo 'style="background-color: #ff3333 ;';} else { echo 'style="background-color:#2379CE;"';} ?>>
                
                <div style="color: #fff;">
                <h2 style="color: #fff; text-align: center;">Message</h2>
                    <p style="text-align: center;">{{ Session::get('message') }}</p>
                    
                    <div class="row" style="margin-top: 15px; margin-bottom: 20px;">
                                
                    </div>

                    <div class="row">
                        <a href="view-quote-requests"><button class="md-close btn-sm btn-inverse waves-effect waves-light">View</button></a>
                        <button class="md-close btn-sm btn-inverse waves-effect waves-light">Close</button>
                    </div>
                </div>
            </div>
        </div></center>

<span hidden><a href="javascript:;" class="md-trigger2" style="font-family: 'Nunito', sans-serif;" data-modal="data-modal-add"><i class="md md-loop"></i> Click Here</a></span>
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
                                            <input class=" form-control" id="firstname" name="firstname" type="text" required>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="lastname" class="control-label col-lg-3">Lastname *</label>
                                        <div class="col-lg-9">
                                            <input class=" form-control" id="lastname" name="lastname" type="text" required>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="address" class="control-label col-lg-3">Address *</label>
                                        <div class="col-lg-9">
                                            <input class="form-control " id="address" name="address" type="text" required>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="city" class="control-label col-lg-3">City *</label>
                                        <div class="col-lg-4">
                                            <input class="form-control " id="city" name="city" type="text" required>
                                        </div>
                                        <label for="zip" class="control-label col-lg-2">Zip</label>
                                        <div class="col-lg-3">
                                            <input class="form-control " id="zip" name="zip" type="text">
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="email" class="control-label col-lg-3">Email *</label>
                                        <div class="col-lg-9">
                                            <input class="form-control " id="email" name="email" type="email" required>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="phone" class="control-label col-lg-3">Phone *</label>
                                        <div class="col-lg-9">
                                            <input class="form-control " id="phone" name="phone" type="text" required>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="contact" class="control-label col-lg-3">Contact via *</label>
                                        <div class="col-lg-9">
                                        <div class="radio radio-info">
                                            <div class="col-md-3">
                                            <input class="form-control " id="contact" name="contact" type="radio" value="Phone" required>
                                            <label for="contact">Phone</label>
                                            </div>
                                            <div class="col-md-3">
                                            <input class="form-control " id="contact" name="contact" type="radio" value="Email" required>
                                            <label for="contact">Email</label>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
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
                                    </div>
                                    <div class="form-group " id="divTask" hidden>
                                        <label for="task" class="control-label col-lg-3">Task *</label>
                                        <div class="col-md-8">
                                            <select multiple class="form-control" name="task[]" id="task" required>
                                                </select>
                                            <p>Press Control to select multiple tasks</p>
                                        </div>
                                    </div>
                                    <br/>
                                    <hr>
                                    <h4>EVENT DETAILS</h4> 
                                    <br/>
                                    <div class="form-group ">
                                        <label for="guests" class="control-label col-lg-3">No. of guests *</label>
                                        <div class="col-lg-9">
                                            <input class="form-control " id="guests" name="guests" type="number" min="1" required>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="eventdate" class="control-label col-lg-3">Event Date *</label>
                                        <div class="col-lg-9">
                                            <input class="form-control " id="eventdate" name="eventdate" type="date" required>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="eventdays" class="control-label col-lg-3">No. of event days *</label>
                                        <div class="col-lg-9">
                                            <input class="form-control " id="eventdays" name="eventdays" type="number" min="1" required>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="eventtime" class="control-label col-lg-3">Event Time *</label>
                                        <div class="col-lg-9">
                                            <div class="input-group bootstrap-timepicker timepicker">
                                                <input id="eventtime" name="eventtime" type="text" class="form-control"  data-minute-step="1" data-template="false" data-modal-backdrop="true" required>
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="objective" class="control-label col-lg-3">Objective of the event</label>
                                        <div class="col-lg-9">
                                            <textarea class="form-control" id="objective" name="objective" rows="5" placeholder="Explain the objective of your event in detail" required></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="" class="control-label col-lg-3">Event Meant for *</label>
                                        <div class="col-lg-3">
                                        <div class="checkbox checkbox-primary">
                                            <div class="col-md-12">
                                            <input class="form-control " id="guesttype" name="guesttype[]" type="checkbox" value="Adult">
                                            <label for="">Adult</label>
                                            </div>
                                            <div class="col-md-12">
                                            <input class="form-control " id="guesttype" name="guesttype[]" type="checkbox" value="Children">
                                            <label for="">Children</label>
                                            </div>
                                            <div class="col-md-12">
                                            <input class="form-control " id="guesttype" name="guesttype[]" type="checkbox" value="Senior Citizen">
                                            <label for="">Senior Citizen</label>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                    <!--<div class="form-group ">
                                        <label for="vehicle" class="control-label col-lg-3">Vehicle Parking Space *</label>
                                        <div class="col-lg-9">
                                            <select class="form-control" name="task" id="task" required>
                                                <option value="">Select Vehicle Packing Space</option>
                                                <option value="0-20">0-20</option>
                                                <option value="20-50">20-50</option>
                                                <option value="50-100">50-100</option>
                                                <option value="100-150">100-150</option>
                                                </select>
                                        </div>
                                    </div>-->

                                    <br/>
                                    <hr>
                                    <div class="form-group ">
                                        <div class="col-lg-offset-3 col-lg-9">
                                            <button class="btn btn-success waves-effect waves-light" type="submit">Save & Continue</button>
                                            <button class="btn btn-default waves-effect" type="button">Cancel</button>
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
            @if(Session::has('message'))
            window.onload  = function() {
                init2(); };
                $(window).resize();
            @endif
            $('#eventtime').timepicker();
            $('#eventType').change(function(){
                var event = $('#eventType').val();
                $.ajax({
                    type: 'post',
                    url: 'request-a-quote/task',
                    data: {event: event, '_token': '{!! csrf_token() !!}'},
                    beforeSend: function(){
                        $('#spin').show();
                    },
                    success: function(data) {
                        $('#spin').hide();
                        $('#divTask').show();
                        var task = $('#task');
                        task.empty();
                        //task.append($("<option></option>")
                            //.attr("value", '').text('Select a Task'));
                        $.each(data, function(i, element) {
                            task.append($("<option></option>")
                            .attr("value", element.Task).text(element.Task));
                        });
                    },
                    error: function(data){
                        alert("fail");
                    }
                });
            });
            
        });
    </script>

    <script>

        function init2() 
        {

            var overlay = document.querySelector( '.md-overlay' );

            [].slice.call( document.querySelectorAll( '.md-trigger2' ) ).forEach( function( el, i ) 
            {

                var modal = document.querySelector( '#' + el.getAttribute( 'data-modal' ) ),
                close = modal.querySelector( '.md-close' );
                classie.add( document.documentElement, 'md-perspective' );

                function removeModal( hasPerspective ) 
                {
                    classie.remove( modal, 'md-show' );
                    //if( hasPerspective ) 
                   // {
                    classie.remove( document.documentElement, 'md-perspective' );
                    //}
                }

                function removeModalHandler() 
                {
                    removeModal( classie.has( el, 'md-setperspective' ) ); 
                }

                    classie.add( modal, 'md-show' );
                    close.addEventListener( 'click', function( ev ) 
                    {
                    ev.stopPropagation();
                    removeModalHandler();
                    });

            } );
        }

    </script>

    <script type="text/javascript">
        $("#demo").click(function(){
            $("#firstname").val("Hasitha");
            $("#lastname").val("Jayasinghe");
            $("#address").val("Pitakotte");
            $("#city").val("Pitakotte");
            $("#zip").val("10100");
            $("#email").val("hasitha.aja@gmail.com");
            $("#phone").val("0773685526");
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
    <script src="assets/timepicker/bootstrap-timepicker.min.js"></script>
    <script src="assets/timepicker/bootstrap-datepicker.js"></script>


@endsection


@section('jquery')
        
@endsection




