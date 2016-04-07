{{-- Home Page --}}

@extends('master')

@section('content')
<div class="content">
	<div class="container">

        
		<!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <h4 class="pull-left page-title">Your Todo List</h4>
                <ol class="breadcrumb pull-right">
                    <li><a href="#">Dashboard</a></li>
                    <li class="active">Your Todo List</li>
                </ol>
            </div>
        </div>

        <div class="col-lg-12"> 
                <ul class="nav nav-tabs navtab-bg"> 
                    <li class="active"> 
                        <a href="#active" data-toggle="tab" aria-expanded="true"> 
                            <span class="visible-xs"><i class="fa fa-home"></i></span> 
                            <span class="hidden-xs">Active</span> 
                        </a> 
                    </li> 
                    <li class=""> 
                        <a href="#archieved" data-toggle="tab" aria-expanded="false"> 
                            <span class="visible-xs"><i class="fa fa-user"></i></span> 
                            <span class="hidden-xs">Archieved</span> 
                        </a> 
                    </li> 
                    <li class=""> 
                        <a href="#deleted" data-toggle="tab" aria-expanded="false"> 
                            <span class="visible-xs"><i class="fa fa-envelope-o"></i></span> 
                            <span class="hidden-xs">Deleted</span> 
                        </a> 
                    </li> 
                </ul> 
                <div class="tab-content"> 
                    <div class="tab-pane active" id="active"> 
                        <table class="table table-bordered table-striped" id="datatable-editable">
                            <thead>
                                <tr>
                                    <th>Todo Description</th>
                                    <th>Status</th>
                                    <th>Date Added</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($todoListActive as $todoItem)
                                    <tr class="gradeX">
                                        <td>{{ $todoItem->description }}</td>
                                        <?php 
                                            $status = null;

                                            switch($todoItem->status){
                                                case "true":
                                                    $status = "Completed";
                                                    break;
                                                case "false":
                                                    $status = "Not Completed";
                                                    break;
                                                default:
                                                    $status = null;
                                            }
                                        ?>
                                        <td>{{ $status }}</td>
                                        <td>{{ $todoItem->date_added }}</td>
                                        <td class="actions">
                                            <a href="#" class="hidden on-editing save-row"><i class="fa fa-save"></i></a>
                                            <a href="#" class="hidden on-editing cancel-row"><i class="fa fa-times"></i></a>
                                            <a href="#" class="on-default edit-row"><i class="fa fa-pencil"></i></a>
                                            <a href="#" class="on-default remove-row"><i class="fa fa-trash-o"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div> 
                    <div class="tab-pane" id="archieved"> 
                        <table class="table table-bordered table-striped" id="datatable-editable2">
                            <thead>
                                <tr>
                                    <th>Todo Description</th>
                                    <th>Status</th>
                                    <th>Date Added</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($todoListArchieved as $todoItem)
                                    <tr class="gradeX">
                                        <td>{{ $todoItem->description }}</td>
                                        <?php 
                                            $status = null;

                                            switch($todoItem->status){
                                                case "true":
                                                    $status = "Completed";
                                                    break;
                                                case "false":
                                                    $status = "Not Completed";
                                                    break;
                                                default:
                                                    $status = null;
                                            }
                                        ?>
                                        <td>{{ $status }}</td>
                                        <td>{{ $todoItem->date_added }}</td>
                                        <td class="actions">
                                            <a href="#" class="hidden on-editing save-row"><i class="fa fa-save"></i></a>
                                            <a href="#" class="hidden on-editing cancel-row"><i class="fa fa-times"></i></a>
                                            <a href="#" class="on-default edit-row"><i class="fa fa-pencil"></i></a>
                                            <a href="#" class="on-default remove-row"><i class="fa fa-trash-o"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div> 
                    <div class="tab-pane" id="deleted"> 
                        <table class="table table-bordered table-striped" id="datatable-editable3">
                            <thead>
                                <tr>
                                    <th>Todo Description</th>
                                    <th>Status</th>
                                    <th>Date Added</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($todoListDeleted as $todoItem)
                                    <tr class="gradeX">
                                        <td>{{ $todoItem->description }}</td>
                                        <?php 
                                            $status = null;

                                            switch($todoItem->status){
                                                case "true":
                                                    $status = "Completed";
                                                    break;
                                                case "false":
                                                    $status = "Not Completed";
                                                    break;
                                                default:
                                                    $status = null;
                                            }
                                        ?>
                                        <td>{{ $status }}</td>
                                        <td>{{ $todoItem->date_added }}</td>
                                        <td class="actions">
                                            <a href="#" class="hidden on-editing save-row"><i class="fa fa-save"></i></a>
                                            <a href="#" class="hidden on-editing cancel-row"><i class="fa fa-times"></i></a>
                                            <a href="#" class="on-default edit-row"><i class="fa fa-pencil"></i></a>
                                            <a href="#" class="on-default remove-row"><i class="fa fa-trash-o"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div> 
                </div> 
        </div> 

    </div>
</div>

@endsection

@section('header-css')
    <link rel="stylesheet" href="{{asset('assets/jquery-datatables-editable/datatables.css')}}" />
@endsection

@section('footer-js')
	<script>
        var resizefunc = [];
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#datatable-editable2').dataTable();
            $('#datatable-editable3').dataTable();
        } );
    </script>

	<script src="{{asset('assets/responsive-table/rwd-table.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/jquery-datatables-editable/jquery.dataTables.js')}}"></script> 
    <script src="{{asset('assets/datatables/dataTables.bootstrap.js')}}"></script>
    <script src="{{asset('assets/jquery-datatables-editable/datatables.editable.init.js')}}"></script>

@endsection