@extends('master')
@section('header-css')

@endsection
@section('header-js')

@endsection
@section('content')

<script>

    var ModalEffects = (function() 
    {

    function init2() 
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

     


            init2();

        





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
                                                </div>
                                                
                                                
                                                <div class="form-group">
                                                    <div class="col-lg-offset-2 col-lg-10">
                                                        <button class="btn btn-success waves-effect waves-light" id="btnsub" type="submit">Save</button>
                                                        <a href="javascript:;" class="md-trigger" data-modal="data-modal-sure"><button type="button" onclick="javascript:;" class="btn btn-danger waves-effect waves-light" data-modal="data-modal-sure">Delete</button></a>
                                                    </div>
                                                </div>
                                            </form>
                                        
                                    </div> <!-- panel-body -->
                                </div> <!-- panel -->
                            </div> <!-- col -->

                        </div> <!-- End row -->
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
