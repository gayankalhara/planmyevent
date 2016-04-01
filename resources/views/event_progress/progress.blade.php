

{{-- Home Page --}}

@extends('master')

@section('header-css')



  <link rel="stylesheet" type="text/css" media="screen" href="{{asset('css/loaders.min.css')}}">

  <link href="{{asset('assets/select2/select2.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('header-js')
  <script type="text/javascript">
    function updateTextInput(val) {
      document.getElementById('textInput').value=val; 
    }
  </script>
@endsection

@section('content')                  

                <div class="content">
                    <div class="container">

                        <!-- Page-Title -->


                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">Update Event Progress</h3>
                                    </div>
                                    <div class="panel-body">
                                        <form class="form-horizontal">
                                            <div class="form-group">
                                                <label for="range_01" class="col-sm-2 control-label">Default<span class="text-muted clearfix">Start without params</span></label>
                                                <div class="col-sm-10">
                                                    <input type="range" name="rangeInput" min="0" max="100" onchange="updateTextInput(this.value);">
                                                    <input type="text" id="textInput" value="">
                                                </div>
                                            </div>
                                            
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div><!-- Row -->

                    </div> <!-- container -->
                               
                </div> <!-- content -->

            <!-- ============================================================== -->
            <!-- End Right content here -->
            <!-- ============================================================== -->




@endsection




@section('footer-css')


@endsection

@section('footer-js')






@endsection
    
        

