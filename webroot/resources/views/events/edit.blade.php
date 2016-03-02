@extends('master')

@section('content')


<script type="text/javascript">


  $(document).ready(function() {
        
        
        //the min chars for username
        var min_chars = 3;
        
        //result texts
        var characters_error = 'Minimum amount of chars is 3';
        var checking_html = 'Checking...';
        
        //when button is clicked
        $('#evname').keyup(function(){
            //run the character number check
            if($('#evname').val().length < min_chars){
                //if it's bellow the minimum show characters_error text
                $('#availability_result').html(characters_error);
            }else{          
                //else show the cheking_text and run the function to check
                $('#availability_result').html(checking_html);
                check_availability();
            }
        });
        
        
  });

//function to check username availability   
function check_availability(){
        
        //get the username
        var username = $('#evname').val();
        
        //use ajax to run the check
        $.post("check_username", { username: username },
            function(result){
                //if the result is 1
                if(result == 1){
                    //show that the username is available
                    $('#availability_result').html('<span class="is_available"><b> <i class="ion-checkmark-round"></i></b></span>');
                    
                    $('#btnsub').attr("disabled", false);
                }else{
                    //show that the username is NOT available
                    $('#availability_result').html('<span class="is_not_available"><b>'+username + ' is already in the Database</span>');
                    
                    $('#btnsub').attr("disabled", true);
                }
        });

}  


function img_pathUrl(input){
   $('#prew')[0].src = (window.URL ? URL : webkitURL).createObjectURL(input.files[0]);
}

</script>
<style type='text/css'>

body{
    font-family: 'tahoma';
}
input{
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
    <div class="content">
    <div class="container">
    <h3>Edit Event : {{ $EventName }}</h3>
                        <div class="row">

                            <div class="col-md-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading"><h3 class="panel-title"></h3></div>
                                    <div class="panel-body">
                                        
                                            <form role="form" name="frm_upload" enctype="multipart/form-data" class="cmxform form-horizontal tasi-form" action = "edit"  method="post">
                                            {!! csrf_field() !!}
                                                <div class="form-group ">
                                                    <label for="exampleInputPassword1">Event Name</label>
                                                        <input class=" form-control" id="evname" value="<?php echo $EventName ?>" readonly name="evname" type="text" required="" aria-required="true">
                                                        <div id='availability_result'></div>
                                                </div>
                                                <div class="form-group">
                                               <label for="exampleInputPassword1">Icon Image</label>
                                                <div style="float:bottom" class="fileUpload btn btn-primary waves-effect waves-light">
                                                    <span>Upload</span>
                                                    <input onChange="img_pathUrl(this);" class="upload" type="file" id="img" accept=".png" name="img">
                                                    
                                                </div>
                                               
                                                <div>
                                                <img id="prew" style="margin-left:20px" src="#" width="40px" height="40px" alt=""/>
                                                </div>
                                                
                                               
                                                </div>
                                                <div class="form-group ">
                                                <label for="exampleInputPassword1">Services</label>
                                                    <select style="height:150px" multiple name="eservices[]" class="form-control" aria-required="true" required="">
                                                    <?php 
                                                    $services = DB::select('SELECT distinct Service FROM services') ;
                                                   $result4= DB::select('select Task from event_types where EventName = ?',[$EventName]);
                                                    $tasks = array();    

                                                        foreach($result4 as $x)
                                                        {
                                                           $tasks[]= $x->Task;
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
                                                
                                                
                                                <div class="form-group">
                                                    <div class="col-lg-offset-2 col-lg-10">
                                                        <button class="btn btn-success waves-effect waves-light" id="btnsub" type="submit">Save</button>
                                                        <button name = "deltype" id = "delete" class="btn btn-danger waves-effect waves-light" type="submit">Delete</button>
                                                    </div>
                                                </div>
                                            </form>
                                        
                                    </div> <!-- panel-body -->
                                </div> <!-- panel -->
                            </div> <!-- col -->

                        </div> <!-- End row -->
</div>
</div>

     <script>

            jQuery(document).ready(function(){
                $('.wysihtml5').wysihtml5();

                $('.summernote').summernote({
                    height: 200,                 // set editor height

                    minHeight: null,             // set minimum height of editor
                    maxHeight: null,             // set maximum height of editor

                    focus: true                 // set focus to editable area after initializing summernote
                });

            });
        </script>

@endsection
