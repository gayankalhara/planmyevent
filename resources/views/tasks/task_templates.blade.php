
@extends('master')


@section('header-css')
    <link href="{{asset('assets/datatables/jquery.dataTables.min.css')}}" rel="stylesheet" type="text/css" />
@endsection


@section('header-js')
    
@endsection


@section('content')
 <div class="content">
    <div class="container">
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
        <div class="row">
            <div class="col-sm-12">
                <h4 class="pull-left page-title">Tasks List</h4>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12 ">
                            <div class="sticky-table-header fixed-solution table-responsive">
                                <table id="datatable" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Event Name</th>
                                            
                                            <th>Edit</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php 
                                        use App\Models\Task_Templates;
                                        foreach($result as $todo)
                                        {
                                            echo '<tr>';
                                            echo '<td ><b> <font size="4">
                                            '.$todo->EventName.'</font> </b>
                                            <table class="table table-striped table-borderd">
                                            <thead>
                                            <td width="300px"><b>To Do Task</b></td>
                                            <td><b>Description</b></td>
                                            </thead>
                                            <tbody>';
                                                $result2 = Task_Templates::select('*')->where('EventName',$todo->EventName)->get();
                                                foreach($result2 as $todo2)
                                                {
                                                echo '<tr>';
                                                echo '<td>'.$todo2->ToDoTask.'</td>';
                                                echo '<td>'.$todo2->Description.'</td>';
                                                echo '</tr>';
                                                }
                                            echo '</tbody>
                                            </table>
                                            </td>';
                                            echo '<td style="vertical-align:middle;" align="center" ><a href ="tasks/edit?EventName='.$todo->EventName.'" ><i class="fa fa-edit"></i></td>';
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
