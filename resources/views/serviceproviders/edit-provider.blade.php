@extends('master')

@section('header-js')

@endsection
@section('content')

@section('header-css')

@endsection

@section('header-js')

@endsection

 
<?php
$company = $_GET['CompanyName'];
$service = $_GET['Service'];
?>
@section('content')
<div class="content">
<div class="container">
    
    <div class="row">
        <div class="col-md-8 col-md-offset-1">
            <div class="panel panel-default"> 
                <div class="col-md-12">
                        <br/>
                        <center><h1>Edit Service Provider  : {{$company}} : ( {{$service}} )</h1></center>
                        <br/>
                </div>
            <div class="col-md-12">
                    <div class="panel panel-default">  
                            <div class="panel-body">
                                <div class="form">
                                        <form class="cmxform form-horizontal tasi-form" id="commentForm" method="post" action="edit" novalidate="novalidate">
                                            {!! csrf_field() !!}
                                            <div class="form-group ">
                                                    <label class="control-label col-lg-3" for="cname" >Company Name</label>
                                                    <div class="col-lg-9">
                                                    <input readonly class=" form-control" id="cname" value="<?php echo $company; ?>" name="cname" type="text" required="" aria-required="true">
                                                    </div>
                                                    @if ($errors->first('cname'))
                                                        <div class="col-lg-9 col-lg-offset-3">
                                                        <div class="alert alert-danger"  style="margin-bottom:0; margin-top:5px; padding:6px;">{{$errors->first('cname')}}</div>
                                                        </div>
                                                    @endif
                                                    <div id='availability_result2'></div>
                                            </div>


                                            <div class="form-group ">
                                                    <label class="control-label col-lg-3" for="cemail" >Service</label>
                                                    <div class="col-lg-9">
                                                        <input readonly class="form-control " id="sname" value="<?php echo $service; ?>" type="text" name="sname" required="" aria-required="true">
                                                    </div>
                                                    <div id='availability_result'></div>
                                            </div>


											<?php 
											
											foreach($result as $service)
											{
                                                $servicename = $service->Service;
												$email = $service->Email;
												$telno = $service->TelNo;
												$address = $service->Address;
											}

											?>

                                            <div class="form-group ">
                                            <label class="control-label col-lg-3" for="address">Address</label>
                                                <div class="col-lg-9">
                                                    <input type="text" value = "<?php echo $address ;?>" class="form-control" id="address" name="address">
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
                                                    <input type="text" value = "<?php echo $telno ;?>" class="form-control" id="telno" name="telno">
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
                                                    <input type="text" value = "<?php echo $email ;?>" class="form-control" id="email" name="email">
                                                </div>
                                                @if ($errors->first('email'))
                                                    <div class="col-lg-9 col-lg-offset-3">
                                                    <div class="alert alert-danger"  style="margin-bottom:0; margin-top:5px; padding:6px;">{{$errors->first('email')}}</div>
                                                    </div>
                                                @endif

                                            </div>
                                                
                                            <div class="form-group">
                                                    <div class="col-lg-offset-2 col-lg-10">
                                                        <button id="btnsub"  class="btn btn-success waves-effect waves-light" type="submit">Save</button>
                                                        <button type="button" class="btn btn-danger waves-effect waves-light" data-toggle="modal" data-target="#data-modal-sure">Delete</button>
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


<div id="data-modal-sure" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                  <h4 class="modal-title" id="myModalLabel">Are You Sure You Want To Delete This?</h4>
              </div>
              <div class="modal-body">
              
              <form  method="post" action="edit">
                {!! csrf_field() !!}
                <input hidden name = "delcname"  type="text" value = "<?php echo $company; ?>">
                <input hidden name = "delsname"  type="text" value = "<?php echo $servicename; ?>">
                
               <button type="submit" name="delprov" class="btn btn-danger waves-effect">Delete</button>
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cancel</button>

                </form>
              
              
                 
              
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
</div>
@endsection

@section('footer-css')

@endsection

@section('footer-js')

@endsection