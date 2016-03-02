@extends('master')

@section('header-css')


    <style type='text/css'>
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

@endsection

@section('header-js')

@endsection

@section('content')




    <div class="content">
    <div class="container">
    <h3>Add Event </h3>
                        <div class="row">
                        <div class="col-md-12">
                                <div class="panel panel-default">
                                    
                                    <div class="panel-body">
                                        <form role="form" name="frm_upload" enctype="multipart/form-data" class="cmxform form-horizontal tasi-form" action = "add"  method="post">
                                        {!! csrf_field() !!}
                                            <div class="form-group">
                                               <label for="exampleInputPassword1">Event Name</label>
                                                <input type="text" required class="form-control" id="ename" name="ename">
                                                <div id='availability_result'></div>
                                            </div>
                                            <div class="form-group">
                                            <label for="exampleInputPassword1">Icon Image</label>
                                            <div style="float:bottom" class="fileUpload btn btn-primary waves-effect waves-light">
                                                    <span>Upload</span>
                                                    <input required onChange="img_pathUrl(this);" class="upload" type="file" id="img" accept=".png" name="img">
                                                    
                                            </div>
                                               
                                            <div>
                                                <img id="prew" style="margin-left:20px" src="#" width="40px" height="40px" alt=""/>
                                            </div>
                                            </div>
                                               
                                    
                                     <div class="form-group ">
                                        <label for="exampleInputPassword1">Services</label>
                                        <select style="height:150px" multiple name="eservices[]" class="form-control" aria-required="true" required="">
                                            <?php $services = DB::select('SELECT distinct Service FROM services') ;
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
                                    <div class="form-group">
                                        <button class="btn btn-success waves-effect waves-light" id="btnsub" type="submit">Add</button>
                                    </div>
                                    </form>
                                    </div><!-- panel-body -->

                                </div> <!-- panel -->
                            </div> <!-- col -->

                        </div> <!-- End row -->

</div>
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
        var characters_error = 'Minimum amount of chars is 3';
        var checking_html = 'Checking...';
        
        //when button is clicked
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

function img_pathUrl(input){
   $('#prew')[0].src = (window.URL ? URL : webkitURL).createObjectURL(input.files[0]);
}

</script>


@endsection
@section('jquery')

@endsection