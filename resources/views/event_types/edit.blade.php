@extends('master')
@section('header-css')
    <style type='text/css'>
        input
        {
            padding:5px;
            font-family: 'tahoma';
        }

        .is_available{
            color:green;
        }

        .is_not_available{
            color:red;
        }
    </style>
    <?php
        use App\Models\Event_Types;
        use App\Models\Event_Services;
        use App\Models\Services;
        //get data from tables using EventName from URL
        $services = Services::distinct()->select('Service')->groupBy('Service')->get();
        $result4 = Event_Services::select('Service')->where('EventName', $EventName)->get();
        $result3 = Event_Types::select('*')->where('EventName', $EventName)->get();
        foreach($result3 as $ic)
            {
               $result3= $ic->Icon;
            }
    ?>
@endsection
@section('header-js')

@endsection
@section('content')


<div class="content">
<div class="container">
    
        <div class="row">
                    <div class="col-md-8 col-md-offset-1">
                    <div class="panel panel-default"> 
                    <div class="col-md-12">
                        <br/>
                        <center><h1>Edit Event Type : {{ $EventName }}</h1></center>
                        <br/>
                    </div>
                        <div class="col-md-12">
                                <div class="panel panel-default">
                                    
                                    <div class="panel-body">
                                    <div class="form">
                                        
                                            <form role="form" name="frm_upload" enctype="multipart/form-data" class="cmxform form-horizontal tasi-form" action = "edit"  method="post">
                                            {!! csrf_field() !!}


                                                <div class="form-group ">
                                                    <label class="control-label col-lg-3" for="evname">Event Name</label>
                                                        <div class="col-lg-9">
                                                            <input class=" form-control" id="evname" value="<?php echo $EventName ?>" readonly name="evname" type="text" required="" aria-required="true">
                                                        </div>
                                                        <div id='availability_result'></div>
                                                </div>


                                                <div class="form-group">
                                                    <label class="control-label col-lg-3" for="img">Icon Image</label>
                                                    <div class="col-lg-9">
                                                        <div style="float:bottom" class="fileUpload btn btn-primary waves-effect waves-light">
                                                            <span>Upload</span>
                                                            <input onChange="img_pathUrl(this);" class="upload" type="file" id="img" accept=".png" name="img">
                                                        </div>
                                                        <img id='prew' style='margin-left:20px' src="{{asset('images/event-icons').'/'.$result3}}" width='50px' height='50px' alt=''  title='' >
                                                    </div>
                                                </div>


                                                <div class="form-group ">
                                                    <label class="control-label col-lg-3" for="eservices[]">Services</label>
                                                    <div class="col-lg-9">
                                                        <select style="height:150px" multiple name="eservices[]" class="form-control" aria-required="true" required="">
                                                            <?php 
                                                            $tasks = array();    

                                                                foreach($result4 as $x)
                                                                {
                                                                   $tasks[]= $x->Service;
                                                                }
                                                            foreach($services as $y)
                                                            {

                                                                if(in_array($y->Service , $tasks))
                                                               // echo '<option selected>'.$y->Service.'</option>';   
                                                                echo '<option selected>'.$y->Service.'</option>'; 
                                                            else 
                                                                echo '<option>'.$y->Service.'</option>'; 
                                                            //else
                                                              //  echo '<option >'.$y->Service.'</option>';    
                                                            }
                                                            ?>

                                                        </select>
                                                    </div>
                                                </div>
                                                
                                                
                                                <div class="form-group">
                                                    <div class="col-lg-offset-2 col-lg-10">
                                                        <button class="btn btn-success waves-effect waves-light" id="btnsub" type="submit">Save</button>
                                                        
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

<div  class="md-modal md-effect-1" id="data-modal-sures">
        <div class="md-content" style="background-color: #ff3333 ;">

            <div style="color: #fff;">
            <h2 style="color: #fff; text-align: center;">Confirm</h2>
                <p style="text-align: center;"> Are You Sure You Want To Delete This? </p>
                 
                <div class="row" style="margin-top: 15px; margin-bottom: 20px;">
                            
                </div>

                <div class="row" style="text-align: center;">
                <form  method="post" action="edit">
                {!! csrf_field() !!}
                <input name = "evnamedel" hidden type="text" value = "{{$EventName}}">
                <button type="submit" name="deltype" class="md-delete btn btn-danger waves-effect waves-light">Delete</button>
                <button type="button" class="md-close btn btn-inverse waves-effect waves-light">Cancel</button>

                </form>
                

                </div>
            </div>
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
                <input name = "evnamedel" hidden type="text" value = "{{$EventName}}">
                <button type="submit" name="deltype" class="md-delete btn btn-danger waves-effect waves-light">Delete</button>
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cancel</button>

                </form>
              
              
                 
              
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
</div>
<script type="text/javascript">

function img_pathUrl(input){
   $('#prew')[0].src = (window.URL ? URL : webkitURL).createObjectURL(input.files[0]);
}
       
</script>

@endsection
