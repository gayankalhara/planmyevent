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
                     <a href="#rejected" data-toggle="tab" aria-expanded="false" class=""> 
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
                                       <th>
                                          <center>Event ID</center>
                                       </th>
                                       <th>Customer Name</th>
                                       <th>Email</th>
                                       <th>Telephone</th>
                                       <th>Event Type</th>
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
                                            echo '<td><a href ="quote-requests/view-pending?id='.$quote->id.'" ><center>View  <i class="fa fa-edit"></i></center></td>';
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
                                       <th>
                                          <center>Event ID</center>
                                       </th>
                                       <th>Customer Name</th>
                                       <th>Email</th>
                                       <th>Telephone</th>
                                       <th>Event Type</th>
                                       <th>Task</th>
                                       <th>View Quotes</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                        <tr></tr>
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
                              <table id="datatable" class="table table-striped table-bordered">
                                 <thead>
                                    <tr>
                                       <th>
                                          <center>Event ID</center>
                                       </th>
                                       <th>Customer Name</th>
                                       <th>Email</th>
                                       <th>Telephone</th>
                                       <th>Event Type</th>
                                       <th>Task</th>
                                       <th>View Quotes</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                        <tr></tr>
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
</script>

<script src="{{asset('assets/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/datatables/dataTables.bootstrap.js')}}"></script>

@endsection