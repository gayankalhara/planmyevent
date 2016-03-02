@extends('master')

<!-- Header CSS -->
@section('header-css')
    <link href="{{asset('assets/datatables/jquery.dataTables.min.css')}}" rel="stylesheet" type="text/css" />
@endsection

<!-- Header JavaScript -->
@section('header-js')
    
@endsection

@section('content')
<div class="content">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h3 class="pull-left page-title">Quote Requests</h3>
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
                                            <th><center>Event ID</center></th>
                                            <th>Customer Name</th>
                                            <th>Email</th>
                                            <th>Telephone</th>
                                            <th>Event Type</th>
                                            <th>Status</th>
                                            <th>View Quotes</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                    	<?php
										foreach($result as $quote)
                                        {
                                            echo '<tr>';
                                            echo '<td>'.$quote->id.'</td>';
                                            echo '<td>'.$quote->FirstName.' '.$quote->LastName. '</td>';
                                            echo '<td>'.$quote->Email.'</td>';
                                            echo '<td>'.$quote->Phone.'</td>';
                                            echo '<td>'.$quote->EventType.'</td>';
                                            echo '<td><span style="color: blue;">'.$quote->Status.'</span></td>';
                                            echo '<td><a href =><center>View  <i class="fa fa-edit"></i></center></td>';
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

    <script src="{{asset('assets/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/datatables/dataTables.bootstrap.js')}}"></script>
@endsection