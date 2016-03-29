@extends('master')
 @section('content')

<?php
$company=$data['CompanyName'];
$service=$data['Service'];
?>
<script type="text/javascript" src="{{asset('js/jquery.min.js')}}"></script>
<script type="text/javascript">


  $(document).ready(function() {
        
        
        //the min chars for username
        var min_chars = 3;
        
        //result texts
        var characters_error = 'Minimum amount of chars is 3';
        var checking_html = 'Checking...';
        
        //when button is clicked


        $('#email').keyup(function(){
            //run the character number check
            var inemail = $('#email').val();
            if(inemail.length > 0){
           //return (email);
            if(inemail.match(/^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/)){
                //if it's bellow the minimum show characters_error text
                $('#email_result').html('<span class="is_available"><b> <i class="ion-checkmark-round"></i></b></span>');
                $('#btnsub').attr("disabled", false);
            }else{          
                //else show the cheking_text and run the function to check
                $('#email_result').html('<span class="is_not_available"><b>Email Invalid</span>');
                $('#btnsub').attr("disabled", true);
                }
            }
        });
        $('#telno').keyup(function(){
            //run the character number check
            var intelno = $('#telno').val();
            if(intelno.length > 0){
           //return (email);
            if(intelno.match(/^[0-9]{10}$/)){
                //if it's bellow the minimum show characters_error text
                $('#telno_result').html('<span class="is_available"><b> <i class="ion-checkmark-round"></i></b></span>');
                $('#btnsub').attr("disabled", false);
            }else{          
                //else show the cheking_text and run the function to check
                $('#telno_result').html('<span class="is_not_available"><b>Telephone Number Invalid</span>');
                $('#btnsub').attr("disabled", true);
                }
            }
        });
  });

//function to check username availability   
  
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
 <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading"><h3 class="panel-title">Edit Service Provider</h3></div>
                                    <div class="panel-body">
                                        <div class=" form">
                                            <form class="cmxform form-horizontal tasi-form" id="commentForm" method="post" action="edit" novalidate="novalidate">
                                            {!! csrf_field() !!}
                                                <div class="form-group ">
                                                    <label for="cname" >Company Name</label>
                                                    <input readonly class=" form-control" id="cname" value="<?php echo $company; ?>" name="cname" type="text" required="" aria-required="true">
                                                    <div id='availability_result2'></div>
                                                </div>

                                                <div class="form-group ">
                                                    <label for="cemail" >Service</label>
                                                    <input readonly class="form-control " id="sname" value="<?php echo $service; ?>" type="text" name="sname" required="" aria-required="true">
                                                    <div id='availability_result'></div>
                                                </div>
											<?php 
											$result = DB::select('SELECT * FROM services where CompanyName= ? and Service =?',[$company ,$service]) ;
											foreach($result as $service)
											{
												$email = $service->Email;
												$telno = $service->TelNo;
												$address = $service->Address;
											}

											?>

                                                <div class="form-group ">
                                            <label for="exampleInputPassword1">Address</label>
                                                <input type="text" value = "<?php echo $address ;?>" class="form-control" id="address" name="address">
                                            </div>
                                            <div class="form-group ">
                                            <label for="exampleInputPassword1">Telephone No</label>
                                                <input type="text" value = "<?php echo $telno ;?>" class="form-control" id="telno" name="telno">
                                                <div id="telno_result"></div>
                                            </div>
                                            <div class="form-group ">
                                            <label for="exampleInputPassword1">E-mail</label>
                                                <input type="text" value = "<?php echo $email ;?>" class="form-control" id="email" name="email">
                                                <div id="email_result"></div>

                                            </div>
                                                
                                                <div class="form-group">
                                                    <div class="col-lg-offset-2 col-lg-10">
                                                        <button id="btnsub"  class="btn btn-success waves-effect waves-light" type="submit">Save</button>
                                                        <button id="btndel" name="delprov"  class="btn btn-danger waves-effect waves-light" type="submit">Delete</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div> <!-- .form -->
                                    </div> <!-- panel-body -->
                                </div> <!-- panel -->
                            </div> <!-- col -->

                        </div> <!-- End row -->
</div>
</div>

@endsection