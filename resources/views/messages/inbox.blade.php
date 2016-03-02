{{-- Home Page --}}

@extends('master')

@section('content')

<div class="content">
                    <div class="container">

                        <!-- Page-Title -->
                        <div class="row">
                            <div class="col-sm-12">
                                <h4 class="pull-left page-title">Inbox</h4>
                                <ol class="breadcrumb pull-right">
                                    <li><a href="#">Messages</a></li>
                                    <li class="active">Inbox</li>
                                </ol>
                            </div>
                        </div>

                        <div class="row">
                        
                            <!-- Right Sidebar -->
                            <div class="col-lg-12 col-md-12">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="btn-toolbar" role="toolbar">
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-success waves-effect waves-light "><i class="fa fa-trash-o"></i></button>
                                            </div>
                                            
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-success waves-effect waves-light  dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                  More
                                                  <span class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu">
                                                  <li><a href="#fakelink">Select All</a></li>
                                                  <li><a href="#fakelink">Deselect All</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div> <!-- End row -->
                                
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
                                                        <td class="mail-rateing">
                                                            <i class="fa fa-star"></i>
                                                        </td>
                                                        <td>
                                                            <a href="#">Udesh Hewagama</a>
                                                        </td>
                                                        <td>
                                                            <a href="#">Hello. How are you???</a>
                                                        </td>
                                                        <td>
                                                            <i class="fa fa-paperclip"></i>
                                                        </td>
                                                        <td class="text-right">
                                                            07:23 AM
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td class="mail-select">
                                                            <div class="checkbox checkbox-success">
                                                                <input id="checkbox2" type="checkbox">
                                                                <label for="checkbox2">
                                                                    
                                                                </label>
                                                            </div>
                                                        </td>
                                                        <td class="mail-rateing">
                                                            <i class="fa fa-star text-warning"></i>
                                                        </td>
                                                        <td>
                                                            <a href="#">Hasitha Jayasinghe</a>
                                                        </td>
                                                        <td>
                                                            <a href="#">I want to know the status of my event.</a>
                                                        </td>
                                                        <td>
                                                            
                                                        </td>
                                                        <td class="text-right">
                                                            07:03 AM
                                                        </td>
                                                    </tr>

                                                    <tr class="active">
                                                        <td class="mail-select">
                                                            <div class="checkbox checkbox-success">
                                                                <input id="checkbox3" type="checkbox">
                                                                <label for="checkbox3">
                                                                    
                                                                </label>
                                                            </div>
                                                        </td>
                                                        <td class="mail-rateing">
                                                            <i class="fa fa-star"></i>
                                                        </td>
                                                        <td>
                                                            <a href="#">Lasanthi Kalpani</a>
                                                        </td>
                                                        <td>
                                                            <a href="#">I want to know more details about event packages.</a>
                                                        </td>
                                                        <td>
                                                            <i class="fa fa-paperclip"></i>
                                                        </td>
                                                        <td class="text-right">
                                                            03:00 AM
                                                        </td>
                                                    </tr>

                                                    
                                                
                                                </tbody>
                                            </table>
                                        </div>
                                        
                                        <hr>
                                        
                                        <div class="row">
                                            <div class="col-xs-7">
                                                Showing 1 - 3 of 1
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
                            </div> <!-- end Col-9 -->
                        
                        </div><!-- End row -->



                    </div> <!-- container -->
                               
                </div> <!-- content -->

@endsection