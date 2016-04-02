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

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="panel panel-border panel-success">
                                    <div class="panel-heading"> 
                                        <h3 class="panel-title">These are the things you have to</h3> 
                                    </div> 
                                    <div class="panel-body">
                                <table class="table table-bordered table-striped" id="datatable-editable">
                                    <thead>
                                        <tr>
                                            <th>Rendering engine</th>
                                            <th>Browser</th>
                                            <th>Platform(s)</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="gradeX">
                                            <td>Trident</td>
                                            <td>Internet
                                                Explorer 4.0
                                            </td>
                                            <td>Win 95+</td>
                                            <td class="actions">
                                                <a href="#" class="hidden on-editing save-row"><i class="fa fa-save"></i></a>
                                                <a href="#" class="hidden on-editing cancel-row"><i class="fa fa-times"></i></a>
                                                <a href="#" class="on-default edit-row"><i class="fa fa-pencil"></i></a>
                                                <a href="#" class="on-default remove-row"><i class="fa fa-trash-o"></i></a>
                                            </td>
                                        </tr>
                                        
                                    </tbody>
                                </table>
                            </div>
                                </div>
                            </div>
                        </div> <!-- end row -->
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

	<script src="{{asset('assets/responsive-table/rwd-table.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/jquery-datatables-editable/jquery.dataTables.js')}}"></script> 
    <script src="{{asset('assets/datatables/dataTables.bootstrap.js')}}"></script>
    <script src="{{asset('assets/jquery-datatables-editable/datatables.editable.init.js')}}"></script>

@endsection