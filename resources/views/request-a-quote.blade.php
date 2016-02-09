

/**
 * Created by PhpStorm.
 * User: Hasitha
 * Date: 2/3/2016
 * Time: 10:57 AM
 */

{{-- Home Page --}}

@extends('master')

@section('content')

    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <h1>Request a Quote</h1>
                </div>
            </div>
            <br/>
            <div class="row">
                <div class="col-md-6 col-md-offset-1">
                    <div class="form">
                        <form class="form-horizontal" id="" method="get" action="#" novalidate="novalidate">
                            <div class="form-group ">
                                <label for="firstname" class="control-label col-lg-3">Firstname *</label>
                                <div class="col-lg-9">
                                    <input class=" form-control" id="firstname" name="firstname" type="text">
                                </div>
                            </div>
                            <div class="form-group ">
                                <label for="lastname" class="control-label col-lg-3">Lastname *</label>
                                <div class="col-lg-9">
                                    <input class=" form-control" id="lastname" name="lastname" type="text">
                                </div>
                            </div>
                            <div class="form-group ">
                                <label for="address" class="control-label col-lg-3">Address *</label>
                                <div class="col-lg-9">
                                    <input class="form-control " id="address" name="address" type="text">
                                </div>
                            </div>
                            <div class="form-group ">
                                <label for="city" class="control-label col-lg-3">City *</label>
                                <div class="col-lg-4">
                                    <input class="form-control " id="city" name="city" type="text">
                                </div>
                                <label for="zip" class="control-label col-lg-2">Zip</label>
                                <div class="col-lg-3">
                                    <input class="form-control " id="zip" name="zip" type="text">
                                </div>
                            </div>
                            <div class="form-group ">
                                <label for="email" class="control-label col-lg-3">Email *</label>
                                <div class="col-lg-9">
                                    <input class="form-control " id="email" name="email" type="email">
                                </div>
                            </div>
                            <div class="form-group ">
                                <label for="phone" class="control-label col-lg-3">Phone *</label>
                                <div class="col-lg-9">
                                    <input class="form-control " id="phone" name="phone" type="text">
                                </div>
                            </div>
                            <div class="form-group ">
                                <label for="contact" class="control-label col-lg-3">Contact via *</label>
                                <div class="radio radio-info radio-inline">
                                    <div class="col-md-8">
                                    <input class="form-control " id="contact" name="contact" type="radio" value="phone">
                                    <label for="contact">Phone</label>
                                    </div>
                                    <div class="col-md-4">
                                    <input class="form-control " id="contact" name="contact" type="radio" value="email">
                                    <label for="contact">Email</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group ">
                                <label for="eventType" class="control-label col-lg-3">Event Type *</label>

                            <?php
                                $events = DB::select('select distinct EventName from event_types ');
                            ?>
                                <div class="col-md-9">
                                    <select class="form-control" name="eventType">
                                        @foreach($events as $x)
                                            <option value="{{$x->EventName}}">{{$x->EventName}}</option>
                                        @endforeach
                                    </select>

                                </div>
                            </div>
                            <div class="form-group ">
                                <label for="eventTask" class="control-label col-lg-3">Task *</label>

                                <?php
                                $events = DB::select('select distinct EventName from event_types ');
                                ?>
                                <div class="col-md-9">
                                    

                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-lg-offset-3 col-lg-9">
                                    <button class="btn btn-success waves-effect waves-light" type="submit">Save & Continue</button>
                                    <button class="btn btn-default waves-effect" type="button">Cancel</button>
                                </div>
                            </div>
                        </form>
                    </div> <!-- .form -->
                </div>
            </div>
        </div>
    </div>


@endsection

@section('header-css')
    <link href="{{asset('assets/select2/select2.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('footer-js')
    <script src="{{asset('assets/select2/select2.min.js')}}" type="text/javascript"></script>
    <script type="text/javascript" src="{{asset('assets/jquery-multi-select/jquery.multi-select.js')}}"></script>
@endsection