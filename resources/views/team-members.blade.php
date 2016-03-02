<!-- Load the master page -->
@extends('master')

<!-- Header CSS -->
@section('header-css')
    <link href="{{asset('assets/datatables/jquery.dataTables.min.css')}}" rel="stylesheet" type="text/css" />
@endsection

<!-- Header JavaScript -->
@section('header-js')
    
@endsection

<!-- Header Content -->
@section('content')
<div class="content">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h4 class="pull-left page-title">Team Members</h4>
                <ol class="breadcrumb pull-right">
                       <a href="{{ url('/team-members/add-new') }}"> <button class="btn btn-success waves-effect waves-light" id="btnsub" type="submit">Add New</button></a>
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
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Address</th>
                                            <th style="width: 10%">Actions</th>
                                            
                                        </tr>
                                    </thead>

                                    <tbody>
                                    

                           <?php $result = DB::select('SELECT * FROM team_members') ;


                                    foreach($result as $team_member)
                                    {
                                        echo '<tr>';
                                        echo '<td>'.$team_member->Name.'</td>';
                                        echo '<td>'.$team_member->Email.'</td>';
                                        echo '<td>'.$team_member->Address.'</td>';
                                        echo '<td><button class="btn btn-success waves-effect waves-light">View Specializations</button></td>';
                                        //echo '<td><a href="{{ url(\'/service-providers/edit\')}}?CompanyName='.$sevice->CompanyName.'&Service='.$sevice->Service.'">xx</a></td>';
                                        //echo '<td><a href ="service-providers/edit?CompanyName='.$sevice->CompanyName.'&Service='.$sevice->Service.'" ><i class="fa fa-edit"></i></td>';
                                        ?> 
                                        
                                        <?php
                                        //echo '<td><a href ="{{url(/service-providers/edit?CompanyName='.$sevice->CompanyName.'&Service='.$sevice->Service.')}}" ><i class="fa fa-edit"></i></td>';
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
