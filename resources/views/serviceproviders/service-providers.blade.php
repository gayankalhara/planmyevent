
@extends('master')


@section('header-css')
    <link href="{{asset('assets/datatables/jquery.dataTables.min.css')}}" rel="stylesheet" type="text/css" />
@endsection


@section('header-js')
    
@endsection


@section('content')
 <div class="content">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h4 class="pull-left page-title">Service Providers</h4>
                
<<<<<<< HEAD
                
                
                <ol class="breadcrumb pull-right">
            <a href="{{ url('dashboard/service-providers/add') }}"> <button class="btn btn-success waves-effect waves-light" id="btnsub" >Add New</button></a>
        </ol>
=======
                <ol class="breadcrumb pull-right">
                       <a href="{{ url('/service-providers/add') }}"> <button class="btn btn-success waves-effect waves-light" id="btnsub" type="submit">Add New</button></a>
                </ol>
                
                <ol hidden>
                    <li><a href="javascript:;" class="md-trigger2" style="font-family: 'Nunito', sans-serif;" data-modal="data-modal-add"><i class="md md-loop"></i> Click Here</a></li>
                </ol>
>>>>>>> e29ccdd27609c0470752dbc32f2bca356375a512
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
<<<<<<< HEAD
                            <div class="sticky-table-header fixed-solution table-responsive">
                                <table id="datatable" class="table table-striped table-bordered ">
=======
                                <table id="datatable" class="table table-striped table-bordered">
>>>>>>> e29ccdd27609c0470752dbc32f2bca356375a512
                                    <thead>
                                        <tr>
                                            <th>Company Name</th>
                                            <th>Service</th>
                                            <th>Address</th>
                                            <th>Telephone No</th>
                                            <th>Email</th>
                                            <th>Edit</th>
                                        </tr>
                                    </thead>

                                    <tbody>
<<<<<<< HEAD
                                        <?php 
                                        //GET data passed from controller and display information
=======
                                        <?php $result = DB::select('SELECT * FROM services') ;

>>>>>>> e29ccdd27609c0470752dbc32f2bca356375a512
                                        foreach($result as $sevice)
                                        {
                                            echo '<tr>';
                                            echo '<td>'.$sevice->CompanyName.'</td>';
                                            echo '<td>'.$sevice->Service.'</td>';
                                            echo '<td>'.$sevice->Address.'</td>';
                                            echo '<td>'.$sevice->TelNo.'</td>';
                                            echo '<td>'.$sevice->Email.'</td>';
                                            echo '<td><a href ="service-providers/edit?CompanyName='.$sevice->CompanyName.'&Service='.$sevice->Service.'" ><i class="fa fa-edit"></i></td>';
                                            ?> 
                                            
                                            <?php
                                            echo '</tr>';
                                        }
                                                
                                        ?>
                                    </tbody>
                                </table>
<<<<<<< HEAD
                                </div>
=======

>>>>>>> e29ccdd27609c0470752dbc32f2bca356375a512
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> 


    </div>
</div>
<<<<<<< HEAD



=======
>>>>>>> e29ccdd27609c0470752dbc32f2bca356375a512
@endsection
     
<!-- Footer JavaScript -->
@section('footer-js')

    <script type="text/javascript">
            $(document).ready(function() {
                $('#datatable').dataTable();
            } );
    </script>


    <script src="{{asset('assets/modal-effect/js/classie.js')}}"></script>

    <script>
        var ModalEffects = (function() 
        {

        function init2() 
        {

            <?php if(Session::get('message')=='Record Update Failed') {echo 'sweetAlert("Oops...", "You forgot to add some elements.", "error");';} else { echo 'sweetAlert("Updated successfully!", "Your record is updated...", "success");';} ?>
        }

        @if(Session::has('message'))
            window.onload  = function() {
                init2(); };
                $(window).resize();
        @endif       
                
        })();
    </script>

    <script src="{{asset('assets/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/datatables/dataTables.bootstrap.js')}}"></script>
@endsection
