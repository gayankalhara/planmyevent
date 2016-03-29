{{-- Home Page --}}

@extends('master')

@section('header-css')
    <link href="{{asset('assets/select2/select2.css')}}" rel="stylesheet" type="text/css" />
@endsection



@section('content')
<div class="content">
                    <div class="container">
								<div class="panel panel-default">
                                    <div class="panel-heading"><h3 class="panel-title">Add New Team Member</h3></div>
                                    <div class="panel-body">
                                        <div class=" form">
                                            <form class="cmxform form-horizontal tasi-form" id="signupForm" method="post" action="#" novalidate="novalidate">
                                            {!! csrf_field() !!}
                                                <div class="form-group ">
                                                    <label for="firstname" class="control-label col-lg-2">Name *</label>
                                                    <div class="col-lg-10">
                                                        <input class=" form-control" id="firstname" name="firstname" type="text" required>
                                                    </div>
                                                </div>

                                                <div class="form-group ">
                                                    <label for="email" class="control-label col-lg-2">Email *</label>
                                                    <div class="col-lg-10">
                                                        <input class="form-control " id="email" name="email" type="email">
                                                    </div>
                                                </div>  
                                                <div class="form-group ">
                                                    <label for="password" class="control-label col-lg-2">Address *</label>
                                                    <div class="col-lg-10">
                                                        <input class="form-control " id="address" name="address" type="text">
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <label for="confirm_password" class="control-label col-lg-2">User Name *</label>
                                                    <div class="col-lg-10">
                                                        <input class="form-control " id="username" name="username" type="text">
                                                    </div>
                                                </div>
                                                

                                                <div class="form-group">
                                                    <label class="control-label col-lg-2">Specialization</label>
                                                    <div class="col-sm-9">
                                                        <select class="select2" multiple data-placeholder="Choose one or more specializations...">
                                                          <option value="Photography">Photography</option>
                                                          <option value="Catering">Catering</option>
                                                          <option value="Entertainment">Entertainment</option>
                                                          <option value="Decorations">Decorations</option>
                                                          <option value="Catering">Catering</option>
                                                          <option value="Music and Sounds">Music and Sounds</option>
                                                          <option value="Email Marketing">Email Marketing</option>
                                                          <option value="Social Media Marketing">Social Media Marketing</option>
                                                          <option value="Graphic Designing">Graphic Designing</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                
                                                <div class="form-group">
                                                    <div class="col-lg-offset-2 col-lg-10">
                                                        <button class="btn btn-success waves-effect waves-light" type="submit">Save</button>
                                                        <a href="{{ url('/team-members') }}"><button class="btn btn-default waves-effect" type="button">Cancel</button></a>
                                                    </div>
                                                </div>

                                                
                                            </form>
                                        </div> <!-- .form -->

                                    </div> <!-- panel-body -->
                                </div>
                        </div>

                 </div>
@endsection


@section('header-js')
    <script src="{{asset('js/modernizr.min.js')}}"></script>
@endsection


@section('footer-js')
        <!-- jQuery  -->
        <script src="{{asset('js/jquery.min.js')}}"></script>
        <script src="{{asset('js/bootstrap.min.js')}}"></script>
        <script src="{{asset('js/waves.js')}}"></script>
        <script src="{{asset('js/wow.min.js')}}"></script>
        <script src="{{asset('js/jquery.nicescroll.js')}}" type="text/javascript"></script>
        <script src="{{asset('js/jquery.scrollTo.min.js')}}"></script>
        <script src="{{asset('assets/jquery-detectmobile/detect.js')}}"></script>
        <script src="{{asset('assets/fastclick/fastclick.js')}}"></script>
        <script src="{{asset('assets/jquery-slimscroll/jquery.slimscroll.js')}}"></script>
        <script src="{{asset('assets/jquery-blockui/jquery.blockUI.js')}}"></script>

       <script src="{{asset('js/jquery.app.js')}}"></script>

        <script src="{{asset('assets/timepicker/bootstrap-timepicker.min.js')}}"></script>
        <script src="{{asset('assets/timepicker/bootstrap-datepicker.js')}}"></script>
        <script type="text/javascript" src="{{asset('assets/colorpicker/bootstrap-colorpicker.js')}}"></script>
        <script type="text/javascript" src="{{asset('assets/jquery-multi-select/jquery.multi-select.js')}}"></script>
        <script type="text/javascript" src="{{asset('assets/jquery-multi-select/jquery.quicksearch.js')}}"></script>
        <script src="{{asset('assets/bootstrap-inputmask/bootstrap-inputmask.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/select2/select2.min.js')}}" type="text/javascript"></script>
@endsection

@section('jquery')
            jQuery(document).ready(function() {
                    
                //multiselect start

                $('#my_multi_select1').multiSelect();
                $('#my_multi_select2').multiSelect({
                    selectableOptgroup: true
                });

                $('#my_multi_select3').multiSelect({
                    selectableHeader: "<input type='text' class='form-control search-input' autocomplete='off' placeholder='search...'>",
                    selectionHeader: "<input type='text' class='form-control search-input' autocomplete='off' placeholder='search...'>",
                    afterInit: function (ms) {
                        var that = this,
                            $selectableSearch = that.$selectableUl.prev(),
                            $selectionSearch = that.$selectionUl.prev(),
                            selectableSearchString = '#' + that.$container.attr('id') + ' .ms-elem-selectable:not(.ms-selected)',
                            selectionSearchString = '#' + that.$container.attr('id') + ' .ms-elem-selection.ms-selected';

                        that.qs1 = $selectableSearch.quicksearch(selectableSearchString)
                            .on('keydown', function (e) {
                                if (e.which === 40) {
                                    that.$selectableUl.focus();
                                    return false;
                                }
                            });

                        that.qs2 = $selectionSearch.quicksearch(selectionSearchString)
                            .on('keydown', function (e) {
                                if (e.which == 40) {
                                    that.$selectionUl.focus();
                                    return false;
                                }
                            });
                    },
                    afterSelect: function () {
                        this.qs1.cache();
                        this.qs2.cache();
                    },
                    afterDeselect: function () {
                        this.qs1.cache();
                        this.qs2.cache();
                    }
                });



                // Select2
                jQuery(".select2").select2({
                    width: '100%'
                });
            });
@endsection

