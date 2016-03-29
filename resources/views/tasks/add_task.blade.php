@extends('master')

@section('header-js')

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



@section('content')
    <div class="content">
    <div class="container">
    
                        <div class="row">
                    <div class="col-md-8 col-md-offset-1">
                    <div class="panel panel-default"> 
                    <div class="col-md-12">
                        <br/>
                        <center><h1>Add Task Template : {{$_GET['EventName'] }}</h1></center>
                        <br/>
                    </div>
                        <div class="col-md-12">
                                <div class="panel panel-default">
                                    
                                    <div class="panel-body">
                                    <div class="form">
                                            <form role="form" action="add" method="POST">
                                                {!! csrf_field() !!}    
                                              
                                                <div class="multi-field-wrapper">
                                           <div>
                                                 <button  type="button" style="margin-bottom:20px" class="btn btn-success waves-effect waves-light add-field">Add field</button>
                                                    
                                             </div>
                                             <div>
                                                    
                                                        <input type="hidden" value="<?php echo $_GET['EventName']; ?>" class="form-control" required  name="iEventName">
                                                    
                                             </div>
                                            <center>
                                                  <div class="multi-fields">
                                                    
                                                    <div class="multi-field">
                                                    <div style="float:left; margin-bottom:5px" class="col-lg-4">
                                                      <input placeholder="To Do Task" class="form-control" pattern="[a-zA-Z0-9 ]+" required type="text" name="Task[]">
                                                      @if ($errors->first('Task[]'))
                                                <div class="col-lg-9 col-lg-offset-3">
                                                <div class="alert alert-danger"  style="margin-bottom:0; margin-top:5px; padding:6px;">{{$errors->first('Task[]')}}</div>
                                                </div>
                                                @endif
                                                      </div>
                                                      <div style="float:left; margin-bottom:5px" class="col-lg-8">
                                                      <input placeholder="Description" class="form-control" pattern="[a-zA-Z0-9 ]+" required type="textarea" name="Description[]">
                                                      @if ($errors->first('Description[]'))
                                                <div class="col-lg-9 col-lg-offset-3">
                                                <div class="alert alert-danger"  style="margin-bottom:0; margin-top:5px; padding:6px;">{{$errors->first('Description[]')}}</div>
                                                </div>
                                                @endif
                                                      </div>
                                                      <button style = "margin-bottom:5px;margin-left:-38px"type="button" class="btn btn-danger waves-effect waves-light remove-field"><i class="ion-close-round"></i></button>
                                                    </div>
                                                  </div>
                                               </center>
                                              </div>
                                                
                                                <div class="form-group">
                                                    <div class="col-lg-offset-2 col-lg-10">
                                                        <button id="btnsub"  class="btn btn-success waves-effect waves-light" type="submit">Save</button>
                                                        
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



$('.multi-field-wrapper').each(function() 
{
    var $wrapper = $('.multi-fields', this);
    $(".add-field", $(this)).click(function(e) {
        if ($('.multi-field', $wrapper).length < 15)
        $('.multi-field:first-child', $wrapper).clone(true).appendTo($wrapper).find('input').val('').focus();
    });




    $('.multi-field .remove-field', $wrapper).click(function() 
    {
        if ($('.multi-field', $wrapper).length > 1)
            $(this).parent('.multi-field').remove();
    });
});

</script>
@endsection