
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
                <h4 class="pull-left page-title">Services</h4>
                
                
                
                <ol class="breadcrumb pull-right">
            <a href="{{ url('dashboard/services/add') }}"> <button class="btn btn-success waves-effect waves-light" id="btnsub" >Add New</button></a>
        </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <table id="datatable" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Slug</th>
                                            <th>Service</th>
                                            <th>Description</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php 

                                        foreach($result as $sevice)
                                        {
                                            echo '<tr>';
                                            echo '<td>'.$sevice->ServiceSlug.'</td>';
                                            echo '<td>'.$sevice->Service.'</td>';
                                            echo '<td>'.$sevice->Description.'</td>'; 
                                            echo '<td><a href ="services/edit?&Service='.$sevice->Service.'" ><i class="fa fa-edit"></i></td>';
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
