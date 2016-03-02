@extends('master')

@section('header-js')
<script>

    var ModalEffects = (function() 
    {

    function init3() 
    {

        var overlay = document.querySelector( '.md-overlay' );

        [].slice.call( document.querySelectorAll( '.md-trigger' ) ).forEach( function( el, i ) 
        {

            var modal = document.querySelector( '#' + el.getAttribute( 'data-modal' ) ),
            close = modal.querySelector( '.md-close' );
            del = modal.querySelector( '.md-delete' );

          
            
            
        
            classie.add( document.documentElement, 'md-perspective' );

            function removeModal( hasPerspective ) 
            {
                classie.remove( modal, 'md-show' );
                //if( hasPerspective ) 
               // {
                classie.remove( document.documentElement, 'md-perspective' );
                //}
            }

            function removeModalHandler() 
            {
                removeModal( classie.has( el, 'md-setperspective' ) ); 
            }

                classie.add( modal, 'md-show' );
                close.addEventListener( 'click', function( ev ) 
                {
                ev.stopPropagation();
                removeModalHandler();
                });

                close.addEventListener( 'click', function( ev ) 
                {
                ev.$('#frm_upload').submit();
                removeModalHandler();
                });
                
                

        } );
    }

     


            init3();

        





</script>
@endsection
@section('content')



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
<?php
$company=$data['CompanyName'];
$service=$data['Service'];
?>


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
@section('content')
<div class="content">
    <div class="container">
    <h3 class="panel-title">Edit Service Provider  : {{$company}} : ( {{$service}} )</h3>
 <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading"></div>
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
                                                        <a href="javascript:;" class="md-trigger" data-modal="data-modal-sure"><button type="button" onclick="javascript:;" class="btn btn-danger waves-effect waves-light" data-modal="data-modal-sure">Delete</button></a>
                                                    </div>
                                                </div>
                                            </form>
                                        </div> <!-- .form -->
                                    </div> <!-- panel-body -->
                                </div> <!-- panel -->
                            </div> <!-- col -->

                        </div> <!-- End row -->
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
                <input name = "delcname" hidden type="text" value = "<?php echo $data['CompanyName']; ?>">
                <input name = "delsname" hidden type="text" value = "<?php echo $data['Service']; ?>">
                <button type="submit" name="delprov" class="md-delete btn btn-danger waves-effect waves-light">Delete</button>
                <button type="button" class="md-close btn btn-inverse waves-effect waves-light">Cancel</button>
                </form>
                

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
@endsection