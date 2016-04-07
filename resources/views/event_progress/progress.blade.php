

{{-- Home Page --}}

@extends('master')

@section('header-css')

<!-- ION Slider -->
        <link href="{{asset('assets/ion-rangeslider/ion.rangeSlider.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{asset('assets/ion-rangeslider/ion.rangeSlider.skinFlat.css')}}" rel="stylesheet" type="text/css"/> 

<style>
.progress-item{
  font-family: 'Roboto', sans-serif;
}
</style>


  <link rel="stylesheet" type="text/css" media="screen" href="{{asset('css/loaders.min.css')}}">

  <link href="{{asset('assets/select2/select2.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('header-js')
  <script type="text/javascript">

    function updateTextInput(val,val2) {
      document.getElementsByClassName("displaytxt")[val2.id-1].value=val+"%"; 
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
                                        @foreach($memtasks as $item)
                                              <div class="form-group">
                                                <label for="{{ $item->id }}" class="col-sm-3 control-label"><span class="progress-item clearfix">{{ $item->Description }}</span></label>
                                                <div class="col-sm-6">
                                                    <input value="{{ $item->progress }}" type="text" id="{{ $item->id }}" class="range">
                                                </div>

                                                <div class="col-sm-3">
                                                    <textarea style="width: 100%;" name="status"></textarea>
                                                </div>
                                            </div>
                                        @endforeach
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
<script src="{{asset('assets/ion-rangeslider/ion.rangeSlider.min.js')}}"></script>
<script src="{{asset('assets/ion-rangeslider/ui-sliders.js')}}"></script>
@endsection
    
        

