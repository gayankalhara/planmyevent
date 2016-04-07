{{-- Home Page --}}

@extends('master')

@section('header-css')
<link rel="stylesheet" type="text/css" media="screen" href="{{asset('assets/questionnaire/css/jquery-ui.min.css')}}">
  <link rel="stylesheet" type="text/css" media="screen" href="{{asset('assets/questionnaire/css/demo.css')}}">


  <link rel="stylesheet" type="text/css" media="screen" href="{{asset('css/loaders.min.css')}}">

  <link href="{{asset('assets/select2/select2.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('header-js')

@endsection

@section('content')
<div class="content">
    <div class="wraper container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="row">
                            <div class="panel-body">
                                    <div class="form">
                                        <form  class="cmxform form-horizontal tasi-form">
                                      <?php 
                                        //GET data passed from controller and display information
                                        foreach($quote as $event)
                                        {

                                        
                                      ?>
                                          <div class="form-group ">
                                          <label for="eveid" class="control-label col-lg-4">Event ID</label>
                                            <div class="col-lg-6">
                                               <input readonly class=" form-control" value="{{$event->id}}" id="eveid" name="eveid" type="text" >
                                            </div>
                                          </div>
                                          <div class="form-group ">
                                          <label for="cname" class="control-label col-lg-4">Customer Name</label>
                                            <div class="col-lg-6">
                                               <input readonly class=" form-control" value="{{$event->FirstName}} {{$event->LastName}}" id="cname" name="cname" type="text" >
                                            </div>
                                          </div>
                                          <div class="form-group ">
                                          <label for="email" class="control-label col-lg-4">Customer Email</label>
                                            <div class="col-lg-6">
                                               <input readonly class=" form-control" value="{{$event->Email}}" id="email" name="email" type="text" >
                                            </div>
                                          </div>
                                          <div class="form-group ">
                                          <label for="etype" class="control-label col-lg-4">Event Type</label>
                                            <div class="col-lg-6">
                                               <input readonly class=" form-control" value="{{$event->EventType}}" id="etype" name="etype" type="text" >
                                            </div>
                                          </div>
                                          <div class="form-group ">
                                          <label for="edate" class="control-label col-lg-4">Event Date</label>
                                            <div class="col-lg-6">
                                               <input readonly class=" form-control" value="{{$event->EventDate}}" id="edate" name="edate" type="text" >
                                            </div>
                                          </div>
                                          <div class="form-group ">
                                          <label for="noofg" class="control-label col-lg-4">No of Guests</label>
                                            <div class="col-lg-6">
                                               <input readonly class=" form-control" value="{{$event->Guests}}" id="noofg" name="noofg" type="text" >
                                            </div>
                                          </div>
                                          
                                          </form>
                                  <?php } ?>
                            <div class="sticky-table-header fixed-solution table-responsive">





                                <form action="" method="post" >
                                {!! csrf_field() !!}    
                                <table id="datatable" class="table table-striped table-bordered ">
                                    <thead>
                                        <tr>
                                            <th>Task</th>
                                            <th>Assign Member</th>

                                            
                                        </tr>
                                    </thead>

                                    <tbody>
                                    
                                        <?php 
                                        //GET data passed from controller and display information
                                        foreach($tasks as $task)
                                        {

                                        ?>
                                            <tr>
                                                <td class="col-lg-8">
                                                
                                                <input style="width:100%;border: 0px;background: transparent;" name="desc[]" type="text" readonly value="{{$task->Description}}">
                                                
                                                </td>
                                                <td> <select  id="selectEventTypes[]" class="select2" name="teammember[]" style="margin-right: 8px; text-align: center; display: inline-block;">
                                                    <option value="">-- Select a Member --</option>
                                                        @foreach ($team as $teammem)
                                                            
                                                            <option value="{{ $teammem -> id }}">{{$teammem->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                            </tr>
                                           
                                        <?php   
                                        }
                                                // in the option value change id to user_id
                                        ?>
                                        
                                    </tbody>


                                </table>
                                 <div class="form-group" style="margin-bottom:50px">
                                      <div class="col-lg-offset-2 col-lg-10">
                                            <button id="btnsub"  class="btn btn-success waves-effect waves-light" type="submit">Assign</button>
                                      </div>
                                 </div>
                                </form>
                                

                            
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
                </div> 
</div>
@endsection




@section('footer-css')


@endsection

@section('footer-js')


  <script src="{{asset('assets/select2/select2.min.js')}}" type="text/javascript"></script>

  <script src="{{asset('js/jquery.query-object.js')}}" type="text/javascript"></script>


  <script>








  

  $('#selectEventTypes\\[\\]').select2({
    width: '250px'
  })

  </script>


@endsection






