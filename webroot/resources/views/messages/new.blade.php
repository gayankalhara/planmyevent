{{-- Home Page --}}

@extends('master')

@section('content')
<div class="content">
                    <div class="container">

                        <!-- Page-Title -->
                        <div class="row">
                            <div class="col-sm-12">
                                <h4 class="pull-left page-title">New Message</h4>
                                <ol class="breadcrumb pull-right">
                                    <li><a href="#">Messages</a></li>
                                    <li class="active">New Message</li>
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
                                                <button type="button" class="btn btn-success waves-effect waves-light m-r-5"><i class="fa fa-floppy-o"></i></button>
                                                <button type="button" class="btn btn-success waves-effect waves-light m-r-5"><i class="fa fa-trash-o"></i></button>
                                                <button class="btn btn-purple waves-effect waves-light"> <span>Send</span> <i class="fa fa-send m-l-10"></i> </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="panel panel-default m-t-20">
                                    <div class="panel-body p-t-30">
                                        
                                        <form role="form">
                                            <div class="form-group">
                                                <input type="email" class="form-control" placeholder="To">
                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="Subject">
                                            </div>
                                            <div class="form-group">
                                                <textarea class="wysihtml5 form-control" placeholder="Message body" style="height: 400px"></textarea>
                                            </div>
                                        </form>
                                    </div> <!-- panel -body -->
                                </div> <!-- panel -->
                            </div> <!-- End Rightsidebar -->
                        
                        </div><!-- End row -->



                    </div> <!-- container -->
                               
                </div> <!-- content -->
@endsection