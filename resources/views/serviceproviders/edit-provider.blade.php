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
                                                        <a href="javascript:;" class="md-trigger" data-modal="data-modal-sure"><button type="button" onclick="javascript:;" class="btn btn-danger waves-effect waves-light" data-modal="data-modal-sure">Delete</button></a>
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

                <input hidden name = "delcname"  type="text" value = "<?php echo $company; ?>">
                <input hidden name = "delsname"  type="text" value = "<?php echo $servicename; ?>">
                <button type="submit" name="delprov" class="md-delete btn btn-danger waves-effect waves-light">Delete</button>
                <button type="button" class="md-close btn btn-inverse waves-effect waves-light">Cancel</button>
                </form>
                

                </div>
            </div>
        </div>
</div>
@endsection

@section('footer-css')

@endsection

@section('footer-js')

@endsection