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
    
                        <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                    <div class="panel panel-default"> 
                    <div class="col-md-12">
                        <br/>
                        <center><h1>Add Service Provider</h1></center>
                        <br/>
                    </div>
                        <div class="col-md-12">
                                <div class="panel panel-default">
                                    
                                    <div class="panel-body">
                                    <div class="form">
                                        <form role="form" name="frm_upload" class="cmxform form-horizontal tasi-form" action = "add" onSubmit="getPath();" method="post">
                                        {!! csrf_field() !!}
                                            <div class="form-group">
                                             <label class="control-label col-lg-3" for="cname">Company Name</label>
                                             <div class="col-lg-9">
                                             <input type="text" class="form-control" id="cname" required name="cname">
                                             <div id='availability_result2'></div>
                                             </div>
                                             
                                                
                                            </div>
                                            <div class="form-group">
                                               <label class="control-label col-lg-3" for="sname">Service</label>
                                               <div class="col-lg-9">
                                                <input type="text" class="form-control" id="sname" required name="sname">
                                                <div id='availability_result'></div>
                                                </div>
                                                
                                            </div>
                                            <div class="form-group ">
                                            <label class="control-label col-lg-3" for="address">Address</label>
                                            <div class="col-lg-9">
                                                <input type="text" class="form-control" id="address" required name="address">
                                                </div>
                                            </div>
                                            <div class="form-group ">
                                            <label class="control-label col-lg-3" for="telno">Telephone No</label>
                                            <div class="col-lg-9">
                                                <input type="text" class="form-control" id="telno" required name="telno">
                                                </div>
                                                <div id="telno_result"></div>
                                            </div>
                                            <div class="form-group ">
                                            <label class="control-label col-lg-3" for="email">E-mail</label>
                                            <div class="col-lg-9">
                                                <input type="text" class="form-control" id="email" required name="email">
                                                </div>
                                                <div id="email_result"></div>
                                            </div>
                                            <div class="form-group">
                                            <div class="col-lg-offset-3 col-lg-9">
                                            	<button class="btn btn-success waves-effect waves-light"  id="btnsub" type="submit">Add</button>
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






@endsection

@section('footer-css')

@endsection

@section('footer-js')
    <script href="{{asset('assets/summernote/summernote.min.js')}}"></script>

    <script type="text/javascript">


      $(document).ready(function() {
            
            
            //the min chars for username
            var min_chars = 3;
            
            //result texts
            var characters_error = 'Minimum amount of chars is 3';
            var checking_html = 'Checking...';
            
            //when button is clicked
            $('#cname').keyup(function(){
                //run the character number check
                if($('#cname').val().length < min_chars){
                    //if it's bellow the minimum show characters_error text
                    $('#availability_result').html(characters_error);
                }else{          
                    //else show the cheking_text and run the function to check
                    $('#availability_result').html(checking_html);
                    check_availability();
                }
            });
            $('#sname').keyup(function(){
                //run the character number check
                if($('#sname').val().length < min_chars){
                    //if it's bellow the minimum show characters_error text
                    $('#availability_result').html(characters_error);
                }else{          
                    //else show the cheking_text and run the function to check
                    $('#availability_result').html(checking_html);
                    check_availability();
                }
            });

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
                if(intelno.match(/\d{10}$/)){
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
    function check_availability(){
            
            //get the username
            var companyname = $('#cname').val();
            var servicename = $('#sname').val();
            //use ajax to run the check
            $.post("check_service", { companyname: companyname , servicename : servicename,'_token': '{!! csrf_token() !!}'},
                function(result){
                    //if the result is 1
                    if(result == 1){
                        //show that the username is available
                        $('#availability_result').html('<span class="is_available"><b> <i class="ion-checkmark-round"></i></b></span>');
                        
                        $('#btnsub').attr("disabled", false);
                    }else{
                        //show that the username is NOT available
                        $('#availability_result').html('<span class="is_not_available"><b> This combination is already in the Database</span>');
                        
                        $('#btnsub').attr("disabled", true);
                    }
            });

    }  
    </script>
@endsection

@section('jquery')

@endsection