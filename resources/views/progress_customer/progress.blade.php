

{{-- Home Page --}}

@extends('master')

@section('header-css')

<!-- ION Slider -->
        <link href="{{asset('assets/ion-rangeslider/ion.rangeSlider.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{asset('assets/ion-rangeslider/ion.rangeSlider.skinFlat.css')}}" rel="stylesheet" type="text/css"/> 

<style>
.progress-item{
  font-family: 'Roboto', sans-serif;
}
</style>


  <link rel="stylesheet" type="text/css" media="screen" href="{{asset('css/loaders.min.css')}}">

  <link href="{{asset('assets/select2/select2.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('header-js')
  <script type="text/javascript">

    function updateTextInput(val,val2) {
      document.getElementsByClassName("displaytxt")[val2.id-1].value=val+"%"; 
    }


  </script>
@endsection

@section('content')                  

                <div class="content">
                    <div class="container">

                        <!-- Page-Title -->


                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading" style="margin-bottom:5px">
                                        <h3 class="panel-title">Event Progress : {{$eveID}}</h3>
                                    </div>
                                    <button class="btn btn-success waves-effect waves-light" data-toggle="modal" data-target="#myModal">Event Details</button>
                                    <button class="btn btn-success waves-effect waves-light" data-toggle="modal" data-target="#myModal2">Team Member Details</button>
                                    
                                    <div class="panel-body">
                                    <div class="col-sm-12" style="float:bottom">
                                    <div class="col-sm-3 control-label" ><h4><center>Task Description</center></h4></div> 
                                    <div class="col-sm-4 control-label" ><h4><center>Completed Percentage</center></h4></div> 
                                    <div class="col-sm-3 control-label" ><h4><center>Notes</center></h4></div>
                                    <div class="col-sm-2 control-label" ><h4><center>Last Updated On</center></h4></div>
                                    </div> 
                                        <form class="form-horizontal" action="" method="post">
                                        {!! csrf_field() !!}    
                                        <input hidden value="{{$eveID}}" name="EventID">
                                        @foreach($memtasks as $item)
                                              <div class="form-group">
                                                <label for="{{ $item->id }}" class="col-sm-3 control-label"><span class="progress-item clearfix">{{ $item->Description }}</span></label>
                                                <input readonly hidden value="{{$item->id}}" name="taskid[]">
                                                <div class="col-sm-4">
                                                    <input readonly value="{{ $item->Percentage }}" name="percentage[]" type="text" id="{{ $item->id }}" class="range">
                                                </div>

                                                <div class="col-sm-3">
                                                    <p style=""><b><center>{{ $item->Status }}</center></b></p> 
                                                </div>
                                                <div class="col-sm-2">
                                                    <p style=""><b><center>{{ $item->LastUpdated }}</center></b></p>
                                                </div>
                                            </div>
                                        @endforeach

                                        
                                        </form>
                                        
                                    </div>
                                </div>
                            </div>
                        </div><!-- Row -->

                    </div> <!-- container -->
                               
                </div> <!-- content -->

            <!-- ============================================================== -->
            <!-- End Right content here -->
            <!-- ============================================================== -->



<!-- ==============Modal to Display Event Details========================== -->
<div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                  <h4 class="modal-title" id="myModalLabel">Event Details</h4>
              </div>
              <div class="modal-body">
              <div style="float:right">
                  <p>Event Status : {{$evedetails['Status']}}</p>
                  <p>Event Audience : {{$evedetails['EventFor']}}</p>
                  <p>Event Duration : {{$evedetails['NoOfDays']}} days</p>
                  <p>No of Added Date : {{$evedetails['Guests']}}</p>
                  </div>
                  <div style="float:bottom">
                  <p>Event ID : {{$evedetails['id']}}</p>
                  <p>Event Type : {{$evedetails['EventType']}}</p>
                  <p style="color:red">Event Date : {{$evedetails['EventDate']}}</p>
                  <p>No of Guests : {{$evedetails['Guests']}}</p>
                  </div>
                  
                  
                  
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
              </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
</div><!-- /.modal -->



<!-- ========================Modal to Display Team Member Details============================= -->
<div id="myModal2" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                  <h4 class="modal-title" id="myModalLabel">Team Member Details</h4>
              </div>
              <div class="modal-body">
              <div style="float:bottom">
                  @foreach($teammem as $x)
                  <p> Name : {{$x->name}} </p>
                  <p> Email : {{$x->email}}</p>
                  <hr>
                  @endforeach
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
              </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
</div>



@endsection




@section('footer-css')


@endsection

@section('footer-js')



<script src="{{asset('assets/ion-rangeslider/ion.rangeSlider.min.js')}}"></script>
<script src="{{asset('assets/ion-rangeslider/ui-sliders.js')}}"></script>
@endsection
    
        


