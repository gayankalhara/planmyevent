{{-- Home Page --}}

@extends('master')

@section('header-css')
<link rel="stylesheet" type="text/css" media="screen" href="{{asset('assets/questionnaire/css/jquery-ui.min.css')}}">
  <link rel="stylesheet" type="text/css" media="screen" href="{{asset('assets/questionnaire/css/demo.css')}}">
  <!-- Only include on form edit page -->
  <link rel="stylesheet" type="text/css" media="screen" href="{{asset('assets/questionnaire/css/form-builder.min.css')}}">
  <!-- Only include on form render page -->
  <link rel="stylesheet" type="text/css" media="screen" href="{{asset('assets/questionnaire/css/form-render.min.css')}}">

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
                            <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="sticky-table-header fixed-solution table-responsive">
                                <table id="datatable" class="table table-striped table-bordered ">
                                    <thead>
                                        <tr>
                                            <th>Event ID</th>
                                            <th>Customer Email</th>
                                            <th>Event Type</th>
                                            <th>No of Guests</th>
                                            <th>Event Date</th>
                                            <th>Assign Tasks</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php 
                                        //GET data passed from controller and display information
                                        foreach($quote as $event)
                                        {
                                            echo '<tr>';
                                            echo '<td>'.$event->id.'</td>';
                                            echo '<td>'.$event->Email.'</td>';
                                            echo '<td>'.$event->EventType.'</td>';
                                            echo '<td>'.$event->Guests.'</td>';
                                            echo '<td>'.$event->EventDate.'</td>';
                                            echo '<td><a href ="assign?EventID='.$event->id.'" ><i class="fa fa-edit"></i></td>';
                                            ?> 
                                            
                                            <?php
                                            echo '</tr>';
                                        }
                                                
                                        ?>
                                    </tbody>
                                </table>

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








  

  $('#selectEventTypes').select2({
    width: '250px'
  })

  </script>


@endsection






