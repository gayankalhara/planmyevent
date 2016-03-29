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
                    <div class="col-md-6">
                        <ul class="nav nav-tabs tabs" style="width: 100%;">
                            <li class="tab" style="width: 25%;">
                                <a href="#pending" data-toggle="tab" aria-expanded="false" class="">
                                    <span class="visible-xs"><i class="fa fa-home"></i></span>
                                    <span class="hidden-xs">Pending</span>
                                </a>
                            </li>
                            <li class="tab" style="width: 25%;">
                                <a href="#approved" id="approveLink" data-toggle="tab" aria-expanded="false" class="">
                                    <span class="visible-xs"><i class="fa fa-home"></i></span>
                                    <span class="hidden-xs">Approved</span>
                                </a>
                            </li>
                            <li class="tab" style="width: 25%;">
                                <a href="#rejected" id="rejectedLink" data-toggle="tab" aria-expanded="false" class="">
                                    <span class="visible-xs"><i class="fa fa-home"></i></span>
                                    <span class="hidden-xs">Rejected</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="tab-content">
                            <div class="tab-pane" id="pending" style="display: block;">
                                <div class="panel panel-default">
                                    <div class="panel-body">
                                        <div class="row">
                                            <table id="pendingTable" class="table table-striped table-bordered">
                                                <thead>
                                                <tr>
                                                    <th>Quote ID</th>
                                                    <th>Customer Name</th>
                                                    <th>Email</th>
                                                    <th>Telephone</th>
                                                    <th>Event Type</th>
                                                    <th>View Quotes</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php
                                                foreach($pending as $quotepending)
                                                {
                                                    echo '<tr>';
                                                    echo '<td>'.$quotepending->QuoteID.'</td>';
                                                    echo '<td>'.$quotepending->FirstName.' '.$quotepending->LastName. '</td>';
                                                    echo '<td>'.$quotepending->Email.'</td>';
                                                    echo '<td>'.$quotepending->Phone.'</td>';
                                                    echo '<td>'.$quotepending->EventType.'</td>';
                                                    echo '<td><a href ="view-quote-requests/pending-quotes?id='.$quotepending->QuoteID.'" ><center>View  <i class="fa fa-edit"></i></center></td>';
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
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="tab-content">
                            <div class="tab-pane" id="approved">
                                <div class="panel panel-default">
                                    <div class="panel-body">
                                        <div class="row">
                                            <table id="approveTable" class="table table-striped table-bordered">
                                                <thead>
                                                <tr>
                                                    <th>Quote ID</th>
                                                    <th>Customer Name</th>
                                                    <th>Email</th>
                                                    <th>Telephone</th>
                                                    <th>Event Type</th>
                                                    <th>View Quotes</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php
                                                foreach($approved as $quoteapproved)
                                                {
                                                    echo '<tr>';
                                                    echo '<td>'.$quoteapproved->QuoteID.'</td>';
                                                    echo '<td>'.$quoteapproved->FirstName.' '.$quoteapproved->LastName. '</td>';
                                                    echo '<td>'.$quoteapproved->Email.'</td>';
                                                    echo '<td>'.$quoteapproved->Phone.'</td>';
                                                    echo '<td>'.$quoteapproved->EventType.'</td>';
                                                    echo '<td><a href ="view-quote-requests/approved-quotes?id='.$quoteapproved->QuoteID.'" ><center>View  <i class="fa fa-edit"></i></center></td>';
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
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="tab-content">
                            <div class="tab-pane" id="rejected">
                                <div class="panel panel-default">
                                    <div class="panel-body">
                                        <div class="row">
                                            <table id="rejectedTable" class="table table-striped table-bordered">
                                                <thead>
                                                <tr>
                                                    <th>Quote ID</th>
                                                    <th>Customer Name</th>
                                                    <th>Email</th>
                                                    <th>Telephone</th>
                                                    <th>Event Type</th>
                                                    <th>View Quotes</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php
                                                foreach($rejected as $quoterejected)
                                                {
                                                    echo '<tr>';
                                                    echo '<td>'.$quoterejected->QuoteID.'</td>';
                                                    echo '<td>'.$quoterejected->FirstName.' '.$quoterejected->LastName. '</td>';
                                                    echo '<td>'.$quoterejected->Email.'</td>';
                                                    echo '<td>'.$quoterejected->Phone.'</td>';
                                                    echo '<td>'.$quoterejected->EventType.'</td>';
                                                    echo '<td><a href ="view-quote-requests/rejected-quotes?id='.$quoterejected->QuoteID.'" ><center>View  <i class="fa fa-edit"></i></center></td>';
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
    </div>
    @endsection

            <!-- Footer JavaScript -->
@section('footer-js')

    <script type="text/javascript">
        $(document).ready(function() {
            $('#pendingTable').dataTable();
        } );
        $("#approveLink").on("click", function(){
            $('#approveTable').dataTable();
        });
        $("#rejectedLink").on("click", function(){
            $('#rejectedTable').dataTable();
        });
    </script>

    <script src="{{asset('assets/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/datatables/dataTables.bootstrap.js')}}"></script>
@endsection