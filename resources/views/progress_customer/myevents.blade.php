
@extends('master')


@section('header-css')
    <link href="{{asset('assets/datatables/jquery.dataTables.min.css')}}" rel="stylesheet" type="text/css" />
@endsection


@section('header-js')
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
@endsection


@section('content')
 <div class="content">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h4 class="pull-left page-title">My Events in Progress : </h4>
                
                
                
                <ol class="breadcrumb pull-right">
            
        </ol>
            </div>
        </div>

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
                                            <th>Event Date</th>
                                            <th>Event Type</th>
                                            <th>Customer Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Update Progress</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php 
                                        //GET data passed from controller and display information
                                        
                                        use App\Models\Quote_Requests;

                                        if($result[0]=='')
                                        {
                                                echo '<tr><td>No Events In Progress</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>';
                                        }
                                        else
                                        {
                                        foreach($result as $item)
                                        {
                                            $evedetails = Quote_Requests::select('*')->where('id',$item->EventID)->first();
                                            echo '<tr>';
                                            echo '<td>'.$evedetails->id.'</td>';
                                            echo '<td>'.$evedetails->EventDate.'</td>';
                                            echo '<td>'.$evedetails->EventType.'</td>';
                                            echo '<td>'.$evedetails->FirstName.' '.$evedetails->LastName.'</td>';
                                            echo '<td>'.$evedetails->Email.'</td>';
                                            echo '<td>'.$evedetails->Phone.'</td>';
                                            echo '<td><a href ="progresscustomer?EventID='.$evedetails->id.'" ><i class="fa fa-edit"></i></td>';
                                            ?> 
                                            
                                            <?php
                                            echo '</tr>';
                                        }
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
     
<!-- Footer JavaScript -->
@section('footer-js')

    <script type="text/javascript">
            $(document).ready(function() {
                $('#datatable').dataTable();
            } );
    </script>


    <script src="{{asset('assets/modal-effect/js/classie.js')}}"></script>



    <script src="{{asset('assets/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/datatables/dataTables.bootstrap.js')}}"></script>
@endsection
