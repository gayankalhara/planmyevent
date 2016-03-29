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
                    <h3 class="pull-left page-title">My Events</h3>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">

                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="row">
                                <table id="myEvents" class="table table-striped table-bordered">
                                    <thead>
                                    <tr>
                                        <th>Event ID</th>
                                        <th>Quote ID</th>
                                        <th>User ID</th>
                                        <th>Event Type</th>
                                        <th>Added Date</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    foreach($events as $key)
                                    {
                                        echo '<tr>';
                                        echo '<td>'.$key->EventID.'</td>';
                                        echo '<td>'.$key->QuoteID.'</td>';
                                        echo '<td>'.$key->UserID.'</td>';
                                        echo '<td>'.$key->EventType.'</td>';
                                        echo '<td>'.$key->AddedDate.'</td>';

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
            $('#myEvents').dataTable();
        });
    </script>

    <script src="{{asset('assets/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/datatables/dataTables.bootstrap.js')}}"></script>
@endsection