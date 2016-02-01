{{-- Home Page --}}

@extends('master')

@section('content')
<div class="content">
                    <div class="container">

                        <!-- Page-Title -->
                        <div class="row">
                            <div class="col-sm-12">
                                <h4 class="pull-left page-title">Team Members</h4>
                                <ol class="breadcrumb pull-right">
                                    <li class="active">Team Members</li>
                                </ol>
                            </div>
                        </div>

                        <div class="row">
                            
                            <!-- Right Sidebar -->
                            <div class="col-md-12 col-lg-12">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="btn-toolbar" role="toolbar">
                                            <div class="btn-group">
                                                <a href="{{ url('/team-members/add-new') }}"><button type="button" class="btn btn-success waves-effect waves-light m-r-5"> <span>Add New</span> <i class="fa fa-plus m-l-10"></i></button></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="panel panel-default m-t-20">
                                    <div class="panel-body">
                                        <div class="table-responsive">
                                            <table class="table table-hover mails">
                                                <tbody>
                                                    <tr>
                                                        <td class="mail-select">
                                                            <div class="checkbox checkbox-success">
                                                                <input id="checkbox1" type="checkbox">
                                                                <label for="checkbox1">
                                                                    
                                                                </label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <a href="#">Udesh Hewagama</a>
                                                        </td>
                                                        <td>
                                                            <a href="#">udeshcheawagama@gmail.com</a>
                                                        </td>
                                                        <td class="text-right">
                                                            Wedding Organizer
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td class="mail-select">
                                                            <div class="checkbox checkbox-success">
                                                                <input id="checkbox1" type="checkbox">
                                                                <label for="checkbox1">
                                                                    
                                                                </label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <a href="#">Hasitha Jayasinghe</a>
                                                        </td>
                                                        <td>
                                                            <a href="#">hasitha.aja@gmail.com</a>
                                                        </td>
                                                        <td class="text-right">
                                                            Decorator
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td class="mail-select">
                                                            <div class="checkbox checkbox-success">
                                                                <input id="checkbox1" type="checkbox">
                                                                <label for="checkbox1">
                                                                    
                                                                </label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <a href="#">Udesh Hewagama</a>
                                                        </td>
                                                        <td>
                                                            <a href="#">udeshcheawagama@gmail.com</a>
                                                        </td>
                                                        <td class="text-right">
                                                            Wedding Organizer
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td class="mail-select">
                                                            <div class="checkbox checkbox-success">
                                                                <input id="checkbox1" type="checkbox">
                                                                <label for="checkbox1">
                                                                    
                                                                </label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <a href="#">Udesh Hewagama</a>
                                                        </td>
                                                        <td>
                                                            <a href="#">udeshcheawagama@gmail.com</a>
                                                        </td>
                                                        <td class="text-right">
                                                            Wedding Organizer
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td class="mail-select">
                                                            <div class="checkbox checkbox-success">
                                                                <input id="checkbox1" type="checkbox">
                                                                <label for="checkbox1">
                                                                    
                                                                </label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <a href="#">Udesh Hewagama</a>
                                                        </td>
                                                        <td>
                                                            <a href="#">udeshcheawagama@gmail.com</a>
                                                        </td>
                                                        <td class="text-right">
                                                            Wedding Organizer
                                                        </td>
                                                    </tr>

                                                    

                                                    
                                                
                                                </tbody>
                                            </table>
                                        </div>
                                        
                                        <hr>
                                        
                                        <div class="row">
                                            <div class="col-xs-7">
                                                Showing 1 - 5 of 1
                                            </div>
                                            <div class="col-xs-5">
                                                <div class="btn-group pull-right">
                                                  <button type="button" class="btn btn-default waves-effect"><i class="fa fa-chevron-left"></i></button>
                                                  <button type="button" class="btn btn-default waves-effect"><i class="fa fa-chevron-right"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    
                                    </div> <!-- panel body -->
                                </div> <!-- panel -->



                            </div> <!-- End Rightsidebar -->
                        
                        </div><!-- End row -->



                    </div> <!-- container -->
                               
                </div> <!-- content -->
@endsection