@extends('master')

@section('header-js')

@endsection
@section('content')

@section('header-css')

@endsection

@section('header-js')

@endsection
 

<?php
$service = $_GET['Service'];

 use App\Models\Services;
        //get data from tables using Service from URL
        $services = Services::select('*')->where('Service',$service)->get();

        foreach($services as $y)
        {
            $ServiceName=$y->Service;
            $Description=$y->Description;
        }
?>
@section('content')
<div class="content">
<div class="container">
    
    <div class="row">
        <div class="col-md-8 col-md-offset-1">
            <div class="panel panel-default"> 
                <div class="col-md-12">
                        <br/>
                        <center><h1>Edit Service : {{$service}} </h1></center>
                        <br/>
                </div>
            <div class="col-md-12">
                    <div class="panel panel-default">  
                            <div class="panel-body">
                                <div class="form">
                                        <form class="cmxform form-horizontal tasi-form" id="commentForm" method="post" action="edit" novalidate="novalidate">
                                            {!! csrf_field() !!}
                                            

                                            <div class="form-group ">
                                                <label class="control-label col-lg-3" for="Service">Service</label>
                                                <div class="col-lg-9">
                                                    <input type="text" readonly class="form-control" id="Service" value="<?php echo $ServiceName; ?>" required name="Service">
                                                </div>
                                                @if ($errors->first('Service'))
                                                    <div class="col-lg-9 col-lg-offset-3">
                                                    <div class="alert alert-danger"  style="margin-bottom:0; margin-top:5px; padding:6px;">{{$errors->first('Service')}}</div>
                                                    </div>
                                                @endif
                                            </div>


                                            <div class="form-group ">
                                                <label class="control-label col-lg-3" for="Description">Description</label>
                                                <div class="col-lg-9">
                                                    <input type="text" class="form-control" id="Description" value="<?php echo $Description; ?>" required name="Description">
                                                </div>
                                                @if ($errors->first('Description'))
                                                    <div class="col-lg-9 col-lg-offset-3">
                                                    <div class="alert alert-danger"  style="margin-bottom:0; margin-top:5px; padding:6px;">{{$errors->first('Description')}}</div>
                                                    </div>
                                                @endif
                                            </div>


                                                
                                            <div class="form-group">
                                                    <div class="col-lg-offset-2 col-lg-10">
                                                        <button id="btnsub"  class="btn btn-success waves-effect waves-light" type="submit">Save</button>
                                                        <button type="button" class="btn btn-danger waves-effect waves-light" data-toggle="modal" data-target="#data-modal-sure">Delete</button>
                                                    </div>
                                            </div>
                                        </form>
                                </div><!--form class div -->
                            </div><!-- panel-body -->

                        </div> <!-- panel -->
                    </div> <!-- col -->
                </div>
            </div>

        </div> <!-- End row -->

</div>
</div>


<div id="data-modal-sure" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                  <h4 class="modal-title" id="myModalLabel">Are You Sure You Want To Delete This?</h4>
              </div>
              <div class="modal-body">
              
              <form  method="post" action="edit">
                {!! csrf_field() !!}

                
                <input hidden name = "delsname"  type="text" value = "<?php echo $service; ?>">
                <button type="submit" name="delserv" class="btn btn-danger waves-effect">Delete</button>

                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cancel</button>
                </form>
                
              
              
                 
              
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
</div>


@endsection

@section('footer-css')

@endsection

@section('footer-js')

@endsection