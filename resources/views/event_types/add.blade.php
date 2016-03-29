@extends('master')

@section('header-css')
<<<<<<< HEAD
    <style type='text/css'>
        input
        {
=======


    <style type='text/css'>
        input{
>>>>>>> e29ccdd27609c0470752dbc32f2bca356375a512
            padding:5px;
            font-family: 'tahoma';
        }

<<<<<<< HEAD
        .is_available
        {
            color:green;
        }

        .is_not_available
        {
=======
        .is_available{
            color:green;
        }

        .is_not_available{
>>>>>>> e29ccdd27609c0470752dbc32f2bca356375a512
            color:red;
        }
    </style>

@endsection

@section('header-js')

@endsection

@section('content')

<<<<<<< HEAD
<div class="content">
<div class="container">
    
    <div class="row">
        <div class="col-md-8 col-md-offset-1">
            <div class="panel panel-default"> 
                <div class="col-md-12">
                        <br/>
                        <center><h1>Add Event Type</h1></center>
                        <br/>
                </div>
                <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="form">
                                    <form role="form" name="frm_upload" enctype="multipart/form-data" class="form-horizontal" action = "add"  method="post">
                                        {!! csrf_field() !!}

                                        <div class="form-group">
                                            <label class="control-label col-lg-3" for="ename">Event Name</label>
                                               <div class="col-lg-9">
                                                    <input type="text" required class="form-control" id="ename" value="{{old('ename')}}" name="ename">
                                                <div id='availability_result'></div>

                                                @if ($errors->first('ename'))
                                                <div class="col-lg-9 col-lg-offset-3">
                                                    <div class="alert alert-danger"  style="margin-bottom:0; margin-top:5px; padding:6px;">{{$errors->first('ename')}}</div>
                                                </div>
                                                @endif
                                                </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-lg-3" for="img">Icon Image</label>
                                            <div class="col-lg-9">
                                                <div style="float:bottom" class="fileUpload btn btn-primary waves-effect waves-light">
                                                    <span>Upload</span>
                                                    <input  onChange="img_pathUrl(this);" class="upload" type="file" id="img" accept=".png" name="img">   
                                                </div>
                                            <img id="prew" style="margin-left:20px"  width="50px" height="50px" src='{{asset('images/event-icons/na.png')}}'/>
                                            </div>
                                        </div>
                                               
                                    
                                     <div class="form-group ">
                                        <label class="control-label col-lg-3" for="eservices[]">Services</label>
                                        <div class="col-lg-9">
                                            <select style="height:150px" multiple id="eservices" name="eservices[]" class="form-control" aria-required="true" required="">
                                                <?php 

                                                  $serv = array();
    										      foreach($services  as $x) 
                                                  {
    	    								           $serv[] = $x->Service;
    										      }	

    										      foreach($serv as $y => $y_value)
    										      {
    											         echo '<option>'.$y_value.'</option>';
    										      }
                                                ?>
                                            </select>
                                        </div>           
                                    </div>


                                    <div class="form-group">
                                        <div class="col-lg-offset-3 col-lg-9">
                                            <button class="btn btn-success waves-effect waves-light" id="btnsub" type="submit">Add</button>
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
=======



    <div class="content">
    <div class="container">
    
                        <div class="row">
                    <div class="col-md-8 col-md-offset-1">
                    <div class="panel panel-default"> 
                    <div class="col-md-12">
                        <br/>
                        <center><h1>Add Event Type</h1></center>
                        <br/>
                    </div>
                        <div class="col-md-12">
                                <div class="panel panel-default">
                                    
                                    <div class="panel-body">
                                    <div class="form">
                                        <form role="form" name="frm_upload" enctype="multipart/form-data" class="form-horizontal" action = "add"  method="post">
                                        {!! csrf_field() !!}
                                            <div class="form-group">
                                               <label class="control-label col-lg-3" for="ename">Event Name</label>
                                               <div class="col-lg-9">
                                                    <input type="text" required class="form-control" id="ename" name="ename">
                                                    <div id='availability_result'></div>
                                                </div>
                                                
                                                
                                            </div>
                                            <div class="form-group">
                                            <label class="control-label col-lg-3" for="img">Icon Image</label>
                                            <div class="col-lg-9">
                                            <div style="float:bottom" class="fileUpload btn btn-primary waves-effect waves-light">
                                                    <span>Upload</span>
                                                    <input  onChange="img_pathUrl(this);" class="upload" type="file" id="img" accept=".png" name="img">   
                                            </div>
                                           </div>
                                                <img id="prew" style="margin-left:20px"  width="50px" height="50px" src='{{asset('images/event-icons/na.png')}}'/>
                                            </div>
                                               
                                    
                                     <div class="form-group ">

                                        <label class="control-label col-lg-3" for="eservices[]">Services</label>
                                        <div class="col-lg-9">
                                        <select style="height:200px" multiple name="eservices[]" class="form-control" aria-required="true" required="">
                                            <?php $services = DB::select('SELECT distinct Service FROM services') ;?>

                                        <label for="exampleInputPassword1">Services</label>
                                        <select style="height:150px" multiple name="eservices[]" class="form-control" aria-required="true" required="">
                                            <?php $services = DB::select('SELECT distinct Service FROM event_services') ;

                                                $serv = array();
    										      foreach($services  as $x) 
                                                  {
    	    								       $serv[] = $x->Service;
    										      }	

    										foreach($serv as $y => $y_value)
    										      {
    											echo '<option>'.$y_value.'</option>';
    										      }
                                            ?>
                                        </select>
                                         </div>           
                                    </div>
                                    <div class="form-group">
                                    <div class="col-lg-offset-3 col-lg-9">
                                        <button class="btn btn-success waves-effect waves-light" id="btnsub" type="submit">Add</button>
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
>>>>>>> e29ccdd27609c0470752dbc32f2bca356375a512
</div>
@endsection
@section('footer-css')

@endsection

@section('footer-js')
<script type="text/javascript">

  $(document).ready(function() {
        
        //the min chars for input
        var min_chars = 3;
        
        //result texts
<<<<<<< HEAD
        var characters_error = '<b>Minimum amount of chars is 3</b>';
        var checking_html = '<i class="fa fa-spin fa-spinner"></i>';
        
        //when typing is clicked
=======
        var characters_error = 'Minimum amount of chars is 3';
        var checking_html = 'Checking...';
        
        //when button is clicked
>>>>>>> e29ccdd27609c0470752dbc32f2bca356375a512
        $('#ename').keyup(function(){
            //run the character number check
            if($('#ename').val().length < min_chars){
                //if it's below the minimum show characters_error text
                $('#availability_result').html(characters_error);
            }else{          
                //else show the cheking_text and run the function to check
                $('#availability_result').html(checking_html);
                check_availability();
            }
        });
        
        
  });

//function to check catname availability   
function check_availability(){
        
        //get the catname
        var catname = $('#ename').val();
        
        //use ajax to run the check
        $.post("check_catname", { catname: catname ,'_token': '{!! csrf_token() !!}'},
            function(result){
                //if the result is 1
                if(result == 1){
                    //show that the catname is available
                    $('#availability_result').html('<span class="is_available"><b> <i class="ion-checkmark-round"></i></b></span>');
                    
                    $('#btnsub').attr("disabled", false);
                }else{
                    //show that the catname is NOT available
                    $('#availability_result').html('<span class="is_not_available"><b>'+catname + ' is already in the Database</span>');
                    
                    $('#btnsub').attr("disabled", true);
                }
        });

}  

<<<<<<< HEAD
//load the image priview on upload
function img_pathUrl(input)
{
=======
function img_pathUrl(input){
>>>>>>> e29ccdd27609c0470752dbc32f2bca356375a512
   $('#prew')[0].src = (window.URL ? URL : webkitURL).createObjectURL(input.files[0]);
}

</script>


@endsection
@section('jquery')

@endsection