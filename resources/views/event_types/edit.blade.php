@extends('master')
@section('header-css')
    <style type='text/css'>
<<<<<<< HEAD
        input
        {
=======
        input{
>>>>>>> e29ccdd27609c0470752dbc32f2bca356375a512
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
<<<<<<< HEAD
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
=======
>>>>>>> e29ccdd27609c0470752dbc32f2bca356375a512
@endsection
@section('header-js')

@endsection
@section('content')


<<<<<<< HEAD
<div class="content">
<div class="container">
    
        <div class="row">
=======
    <div class="content">
    <div class="container">
    
                        <div class="row">
>>>>>>> e29ccdd27609c0470752dbc32f2bca356375a512
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
<<<<<<< HEAD


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
=======
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
                                                <img id="prew" style="margin-left:20px" src="" width="50px" height="50px" alt="" title="" >
                                                </div>
                                                </div>

                                                <div class="form-group ">
                                                <label class="control-label col-lg-3" for="eservices[]">Services</label>
                                                <div class="col-lg-9">
                                                    <select style="height:150px" multiple name="eservices[]" class="form-control" aria-required="true" required="">
                                                    <?php 
                                                    $services = DB::select('SELECT distinct Service FROM services') ;
                                                   $result4= DB::select('select Service from event_services where EventName = ?',[$EventName]);
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
>>>>>>> e29ccdd27609c0470752dbc32f2bca356375a512
                                                    </div>
                                                </div>
                                                
                                                
                                                <div class="form-group">
                                                    <div class="col-lg-offset-2 col-lg-10">
                                                        <button class="btn btn-success waves-effect waves-light" id="btnsub" type="submit">Save</button>
                                                        <a href="javascript:;" class="md-trigger" data-modal="data-modal-sure"><button type="button" onclick="javascript:;" class="btn btn-danger waves-effect waves-light" data-modal="data-modal-sure">Delete</button></a>
                                                    </div>
                                                </div>
<<<<<<< HEAD

                                                
                                            </form>
                                        
                                    </div><!--form class div -->
                                </div><!-- panel-body -->

                            </div> <!-- panel -->
                        </div> <!-- col -->
                    </div>
                </div>

        </div> <!-- End row -->
=======
                                            </form>
                                        
                                    </div><!--form class div -->
                                    </div><!-- panel-body -->

                                </div> <!-- panel -->
                            </div> <!-- col -->
                            </div>
                            </div>

                        </div> <!-- End row -->
>>>>>>> e29ccdd27609c0470752dbc32f2bca356375a512

</div>
</div>

<div  class="md-modal md-effect-1" id="data-modal-sure">
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


<script type="text/javascript">

function img_pathUrl(input){
   $('#prew')[0].src = (window.URL ? URL : webkitURL).createObjectURL(input.files[0]);
}
       
</script>

@endsection
