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

<form class="cmxform form-horizontal tasi-form" id="signupForm" method="post" action="feedback/add" novalidate="novalidate">
        <input type="hidden" name="_token" value="{!! csrf_token() !!}">
        <input id="customerId" value="<?php echo $customerId ?>" type="hidden" name="customerId" type="text" >
        
                        <div class="form-group ">
                            </div>
                                <div class="form-group ">
                                <label for="CutomerName" class="control-label col-lg-2">
                                <!--Customer Name : Customer Name -->
                                </label>

                                </div>
                                  <div class="panel panel-default panel-border"> 


                                     <center><h1>Feedback Form</h1></center>

                        <div class="form-group ">
                                <label for="events" class="control-label col-lg-2">Events</label>
                                <div class="col-lg-10">
                                <select name="event_drop_down">
                                     <?php
                                        foreach($eventsForUser as $value):
                                        echo '<option value="'.$value->eventName.'">'.$value->eventName.'</option>'; //close your tags!!
                                        endforeach;
                                     ?>  
                                                    </select>
  
                                                    </div>
                                                </div>

                                                <div class="form-group ">
                                                    <label for="lastname" class="control-label col-lg-2">Ratings</label>
                                                    <div class="col-lg-10">
                                                    <select name="ratings">
                                                      <option value=1>1</option>
                                                      <option value=2>2</option>
                                                      <option value=3>3</option>
                                                      <option value=4>4</option>
                                                      <option value=4>5</option>
                                                    </select>
  
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <label for="username" class="control-label col-lg-2">Comments</label>
                                                    <div class="col-lg-10">
                                                       <textarea class="form-control " id="ccomment" name="comment" required="" aria-required="true"></textarea>
                                                    </div>
                                                </div>
                                               
                                           
                                                

                                                <div class="form-group">
                                                    <div class="col-lg-offset-2 col-lg-10">

                                                        <button class="btn btn-success waves-effect waves-light" type="submit">Save</button>
                                                        <button class="btn btn-default waves-effect" type="button">Cancel</button>
                                                    </div>
                                                </div>
                                            </form>
                                            </div>

    </div>
</div>
@endsection