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
                                                    <input type="text" class="form-control" id="cname" value="{{old('cname')}}" required name="cname">
                                                    @if ($errors->first('cname'))
                                                        <div class="col-lg-9 col-lg-offset-3">
                                                        <div class="alert alert-danger"  style="margin-bottom:0; margin-top:5px; padding:6px;">{{$errors->first('cname')}}</div>
                                                        </div>
                                                    @endif
                                                <div id='availability_result2'></div>
                                                </div> 
                                            </div>


                                            <div class="form-group">
                                               <label class="control-label col-lg-3" for="sname">Service</label>
                                               <div class="col-lg-9">
                                               <select class="form-control" id="sname"  required name="sname">
                                                    <?php

                                                    $serv = array();
                                                      foreach($result  as $x) 
                                                      {
                                                       $serv[] = $x->Service;
                                                      } 

                                                      foreach($serv as $y => $y_value)
                                                      {
                                                        echo '<option>'.$y_value.'</option>';
                                                      }
                                                    ?>
                                                    </select>
                                                   
                                                    <div id='availability_result'></div>
                                                </div>
                                                
                                            </div>


                                            <div class="form-group ">
                                                <label class="control-label col-lg-3" for="address">Address</label>
                                                <div class="col-lg-9">
                                                    <input type="text" class="form-control" id="address" value="{{old('address')}}" required name="address">
                                                </div>
                                                @if ($errors->first('address'))
                                                    <div class="col-lg-9 col-lg-offset-3">
                                                    <div class="alert alert-danger"  style="margin-bottom:0; margin-top:5px; padding:6px;">{{$errors->first('address')}}</div>
                                                    </div>
                                                @endif
                                            </div>


                                            <div class="form-group ">
                                                <label class="control-label col-lg-3" for="telno">Telephone No</label>
                                                <div class="col-lg-9">
                                                    <input type="text" class="form-control" id="telno" value="{{old('telno')}}" required name="telno">
                                                </div>
                                                @if ($errors->first('telno'))
                                                    <div class="col-lg-9 col-lg-offset-3">
                                                    <div class="alert alert-danger"  style="margin-bottom:0; margin-top:5px; padding:6px;">{{$errors->first('telno')}}</div>
                                                    </div>
                                                @endif
                                            </div>


                                            <div class="form-group ">
                                                <label class="control-label col-lg-3" for="email">E-mail</label>
                                                <div class="col-lg-9">
                                                    <input type="text" class="form-control" id="email" value="{{old('email')}}" required name="email">
                                                </div>
                                                <div id="email_result"></div>
                                                @if ($errors->first('email'))
                                                    <div class="col-lg-9 col-lg-offset-3">
                                                    <div class="alert alert-danger"  style="margin-bottom:0; margin-top:5px; padding:6px;">{{$errors->first('email')}}</div>
                                                    </div>
                                                @endif
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
            
            
            //the min chars for company name
            var min_chars = 3;
            
            //result texts
            var characters_error = '<b>Minimum amount of chars is 3</b>';
            var checking_html = '<i class="fa fa-spin fa-spinner"></i>.';
            
            //when typed
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
            


      });

    //function to check company name availability   
    function check_availability(){
            
            //get the name
            var companyname = $('#cname').val();
            var servicename = $('#sname').val();
            //use ajax to run the check
            $.post("check_service", { companyname: companyname , servicename : servicename,'_token': '{!! csrf_token() !!}'},
                function(result){
                    //if the result is 1
                    if(result == 1){
                        //show that the name is available
                        $('#availability_result').html('<span class="is_available"><b> <i class="ion-checkmark-round"></i></b></span>');
                        
                        $('#btnsub').attr("disabled", false);
                    }else{
                        //show that the name is NOT available
                        $('#availability_result').html('<span class="is_not_available"><b> This combination is already in the Database</span>');
                        
                        $('#btnsub').attr("disabled", true);
                    }
            });

    }  
    </script>
@endsection

@section('jquery')

@endsection