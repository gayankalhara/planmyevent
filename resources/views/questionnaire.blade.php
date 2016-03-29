{{-- Home Page --}}

@extends('master')

@section('header-css')
<link rel="stylesheet" type="text/css" media="screen" href="{{asset('assets/questionnaire/css/jquery-ui.min.css')}}">
  <link rel="stylesheet" type="text/css" media="screen" href="{{asset('assets/questionnaire/css/demo.css')}}">
  <!-- Only include on form edit page -->
  <link rel="stylesheet" type="text/css" media="screen" href="{{asset('assets/questionnaire/css/form-builder.min.css')}}">
  <!-- Only include on form render page -->
  <link rel="stylesheet" type="text/css" media="screen" href="{{asset('assets/questionnaire/css/form-render.min.css')}}">

<<<<<<< HEAD
=======
  <link rel="stylesheet" type="text/css" media="screen" href="{{asset('css/loaders.min.css')}}">

>>>>>>> e29ccdd27609c0470752dbc32f2bca356375a512
  <link href="{{asset('assets/select2/select2.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('header-js')

@endsection

@section('content')
<div class="content">
    <div class="wraper container-fluid">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="bg-picture text-center" style="background-image:url('images/big/bg.jpg')">
                                <div class="bg-picture-overlay">
                                  

<<<<<<< HEAD
                                  <div class="col-lg-6">
                                    <h3 class="text-white" style="text-align: left; margin-left: 20px;     margin-top: 20px;">Question Builder</h3>
                                  </div>

                                  <div class="col-lg-6" style="text-align: right; margin-top: 15px;">
=======
                                  <div class="col-lg-8">
                                    <h3 class="text-white" style="text-align: left; margin-left: 20px;     margin-top: 20px;">Question Builder</h3>
                                  </div>

                                  <div class="col-lg-4" style="text-align: right; margin-top: 15px;">
>>>>>>> e29ccdd27609c0470752dbc32f2bca356375a512
                                    <span style="display: inline-block; color: #fff; margin-right: 10px;  font-size: 16px;">Event Category</span>

                                    <select id="selectEventTypes" class="select2" style="margin-right: 8px; text-align: center; display: inline-block;">
                                      <option value="not-selected">-- Select a Category --</option>
                                      @foreach ($event_types as $eventType)
                                          <option value="{{ $eventType -> EventSlug }}">{{ $eventType -> EventName }}</option>
                                      @endforeach
                                    </select>
                                  </div>
                                </div>

                            </div>
                            <!--/ meta -->
                        </div>
                    </div>
                    <div class="row user-tabs">
                        <div class="col-lg-6 col-md-9 col-sm-9">
                            <ul class="nav nav-tabs tabs">
                            <li class="active tab">
                                <a href="#design" data-toggle="tab" aria-expanded="false" class="active"> 
                                    <span class="visible-xs"><i class="fa fa-home"></i></span> 
                                    <span class="hidden-xs">Design</span> 
                                </a> 
                            </li> 
                            <li class="tab"> 
                                <a href="#preview" data-toggle="tab" aria-expanded="false"> 
                                    <span class="visible-xs"><i class="fa fa-user"></i></span> 
                                    <span class="hidden-xs">Preview</span> 
                                </a> 
                            </li> 

                        <div class="indicator"></div></ul> 
                        </div>
                        <div class="col-lg-6 col-md-3 col-sm-3 hidden-xs">
                            <div class="pull-right">
                            @if (app('request')->input('category') != null)
                              <button class="btn btn-success waves-effect waves-light" id="render-form-button" type="submit">Render</button>

<<<<<<< HEAD
                              <button class="btn btn-success waves-effect waves-light" id="save-template" type="submit">Save</button>
=======
                              <button class="btn btn-success waves-effect waves-light" id="save-template" type="submit">Save Template</button>
>>>>>>> e29ccdd27609c0470752dbc32f2bca356375a512

                              <button class="btn btn-success waves-effect waves-light" id="refresh-button" type="submit">Refresh</button>

                              <button class="btn btn-success waves-effect waves-light" id="frmb-0-edit-xml" type="submit">Edit XML</button>

                              <button class="btn btn-success waves-effect waves-light" id="frmb-0-export-xml" type="submit">View XML</button>

                              <button class="btn btn-success waves-effect waves-light" id="frmb-0-clear-all" type="submit">Clear All</button>
                            @else
                              <button disabled class="btn btn-success waves-effect waves-light" id="render-form-button" type="submit">Render</button>

<<<<<<< HEAD
                              <button disabled class="btn btn-success waves-effect waves-light" id="save-template" type="submit">Save</button>
=======
                              <button disabled class="btn btn-success waves-effect waves-light" id="save-template" type="submit">Save Template</button>
>>>>>>> e29ccdd27609c0470752dbc32f2bca356375a512

                              <button class="btn btn-success waves-effect waves-light" id="refresh-button" type="submit">Refresh</button>

                              <button disabled class="btn btn-success waves-effect waves-light" id="frmb-0-edit-xml" type="submit">Edit XML</button>

                              <button disabled class="btn btn-success waves-effect waves-light" id="frmb-0-export-xml" type="submit">View XML</button>

                              <button disabled class="btn btn-success waves-effect waves-light" id="frmb-0-clear-all" type="submit">Clear All</button>
                            @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12"> 
                        
                        <div class="tab-content profile-tab-content"> 
                            <div class="tab-pane active" id="design"> 
                                <div class="row">







<div class="col-md-12">
                <div class="panel panel-default">

                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                              <!-- MAIN CONTENT -->
                                              <section id="main_content" class="inner">
                                                <div class="build-form">
                                                @if (app('request')->input('category') == null)
                                                  <h3 id="preview-quiz"><strong>You have to select an event category first.</strong></h3>
                                                @else
                                                  <h3><strong>Build The Questionnaire</strong></h3>
                                                  <form action="">
                                                  <?php 
                                                  $fileName = "";
                                                  $fileContents = "";

                                                  if( app('request')->input('category') != null){
                                                      if (File::exists("xml/" . app('request')->input('category') .  ".xml"))
                                                          {
                                                              $fileName = "xml/" . app('request')->input('category') .  ".xml";
                                                              $fileContents = File::get($fileName);
                                                      }
                                                  }                                                

                                                   ?>

                                                    <textarea style="visibility: hidden;" name="form-builder-template" id="form-builder-template" cols="30" rows="10"><?php echo $fileContents; ?></textarea>
                                                  </form>
                                                  <br style="clear:both">
                                                @endif
                                                </div>

                                              </section>
                                            </div>
                        </div>
                    </div>


                </div>
            </div>









                                </div>
                            </div> 


                            <div class="tab-pane" id="preview">
                                <div class="row">



<div class="col-md-12">
                <div class="panel panel-default">

                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">


                                                <div class="render-form">
                                                @if (app('request')->input('category') == null)
                                                  <h3 id="preview-quiz"><strong>You have to select an event category first.</strong></h3>
                                                @else
                                                  <h3 id="preview-quiz"><strong>Questionnaire Preview</strong></h3>
                                                  <form id="rendered-form">
                                                    <p class="cta">Add some fields to the Questionnaire Builder above and render them here.</p>
                                                  </form>
                                                @endif
                                                </div>

                                              </section>
                                            </div>
                        </div>
                    </div>


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




@section('footer-css')


@endsection

@section('footer-js')

  <script src="{{asset('assets/questionnaire/js/jquery-ui.min.js')}}"></script>
  <script src="{{asset('assets/questionnaire/js/jquery.ui.touch-punch.min.js')}}"></script>
  <!-- Only include on form edit page -->
  <script src="{{asset('assets/questionnaire/js/form-builder.js')}}"></script>
  <!-- Only include on form render page -->
  <script src="{{asset('assets/questionnaire/js/form-render.js')}}"></script>

  <script src="{{asset('assets/select2/select2.min.js')}}" type="text/javascript"></script>

  <script src="{{asset('js/jquery.query-object.js')}}" type="text/javascript"></script>


  <script>
  jQuery(document).ready(function($) {
    'use strict';
    var template = document.getElementById('form-builder-template'),
      formContainer = document.getElementById('rendered-form'),
      renderBtn = document.getElementById('render-form-button');
    $(template).formBuilder();

    $(renderBtn).click(function(e) {
      e.preventDefault();
      $(template).formRender({
        container: $(formContainer)
      });
    });
  });


  $("#refresh-button").click(function(){
    var selectedCat = $('#selectEventTypes').select2('data').id;
    if(selectedCat == "not-selected"){
      window.location = window.location.href.split('?')[0];
    } else{
      var selectedCat = $('#selectEventTypes').select2('data').id;
      window.location.search = jQuery.query.set("category", selectedCat);
    }
  });


  $("#save-template").click(function(){
            
            var xmlData = document.getElementById('form-builder-template').value;
            var selectedCat = $('#selectEventTypes').select2('data').id;

            if(selectedCat == "not-selected"){
                sweetAlert("Oops...", "You haven't selected a event category to save.", "error");
            } else{
              document.getElementById('preloader').style.visibility="visible";

              $.post("question-builder/xml-post", { xmlData: xmlData, fileName: "xml/" + selectedCat + ".xml", '_token': '{!! csrf_token() !!}'},
                  function(result){

                      document.getElementById('preloader').style.visibility="hidden";

                      if(result == 1){
                          sweetAlert("Done!", "Questions Successfully saved!", "success");
                      }else{
                          sweetAlert("Oops...", "Something went wrong!", "error");
                      }

              });
            }


  });

  $("#frmb-0-edit-xml").click(function(){
        $('.nav-tabs a[href="#design"]').trigger('click');
  });

@if (app('request')->input('category') != null)
  $('#selectEventTypes').val('{{ app('request')->input('category') }}').change();
@endif

  

  $('#selectEventTypes').select2({
    width: '250px'
  })
        .on("change", function(e) {
          var selectedCat = $('#selectEventTypes').select2('data').id;

          if(selectedCat != "not-selected"){
            window.location.search = jQuery.query.set("category", selectedCat);
          }else{
            window.location = window.location.href.split('?')[0];
          }
        })
  </script>


@endsection