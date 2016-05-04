@extends('master')

<!-- Header CSS -->
@section('header-css')

@endsection

<!-- Header JavaScript -->
@section('header-js')
@endsection

@section('content')
<div class="content">
   <div class="container">

      <div class="row">
         <div class="col-sm-12">
            <center><h3 class="page-title">Add Quote</h3></center>
         </div>
      </div>
      <br/>
            
      <div class="row">
         <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default"> 
              <div class="panel-body"> 
                <label>Quote ID:</label>
                <label>{{$eventID}}</label>
                <br/>
                <label>Event Type:</label>
                <label>{{$eventType}}</label>
                <br/>
                <label>Services:</label>
                <label id="tasklist">{{implode(', ', $services)}}</label>
              </div>
            </div>
         </div>
      </div>
      <div class="row">
         <div class="col-md-8 col-md-offset-2">
            
            <div class="panel panel-default"> 
              <div class="panel-body" id="addForm">
              <h4>Quote Details</h4>
              <div class="col-md-10 col-md-offset-1">
                
                <br/>
                <form class="form-horizontal" id="" method="post" action="send-quotation" >
                  <div>

                  <?php
                       for ($i=1; $i <=$serviceCount; $i++)

                              {
                                  echo '<div class="form-group ">
                                  <label for="'.$services[$i-1].'" class="control-label col-lg-4">'.$services[$i-1].' (USD)</label>
                                  <div class="col-lg-6">
                                  <input class=" form-control" style="text-align: right;" id="cost[]" name="cost[]" type="text" pattern="[0-9]+(\.[0-9][0-9]?)?" placeholder="eg: 1500.00" required>
                                <input class=" form-control" id="serviceName[]" name="serviceName[]" type="hidden" value="'.$services[$i-1].'">


                              </div>

                                        </div>';

                         }

                ?>
                  <hr>

                  <div class="form-group ">
                        <label for="firstname" class="control-label col-lg-4">Sub Total (USD)</label>
                              <div class="col-lg-6">
                                            <input class=" form-control" style="text-align: right;" id="subtotal" name="subtotal" type="text" pattern="[0-9]+(\.[0-9][0-9]?)?" readonly>
                      </div>
                    </div>
                    <div class="form-group ">
                        <label for="firstname" class="control-label col-lg-4">Down Payment (USD)</label>
                              <div class="col-lg-6">
                                            <input class=" form-control" style="text-align: right;" id="downpayment" name="downpayment" type="text" pattern="[0-9]+(\.[0-9][0-9]?)?" readonly>
                      </div>
                    </div>
                    <div class="form-group ">
                        <label for="firstname" class="control-label col-lg-4">Total Payable (USD)</label>
                              <div class="col-lg-6">
                                            <input class=" form-control" style="text-align: right;" id="totalpay" name="totalpay" type="text" pattern="[0-9]+(\.[0-9][0-9]?)?" readonly>
                      </div>
                    </div>
                    <hr>
                    <div class="form-group ">
                                        <label for="remarks" class="control-label col-lg-4">Remarks</label>
                                        <div class="col-lg-6">
                                            <textarea class="form-control" id="remarks" name="remarks" rows="5"></textarea>
                                        </div>
                                    </div>
                                    <hr>
                                    <input type="text" id="taskcount" name="taskcount" value="{{$serviceCount}}" hidden>
                                    <input type="text" id="eventid" name="eventid" value="{{$eventID}}" hidden>
                                    <input type="text" id="eventtype" name="eventtype" value="{{$eventType}}" hidden>
                                    <input type="text" id="services" name="services" value="{{implode(', ', $services)}}" hidden>
                    <div class="form-group ">
                                        <div class="col-lg-offset-4 col-lg-8">
                                            <button class="btn btn-success waves-effect waves-light" type="submit">Add Quote</button>
                                            <button class="btn btn-default waves-effect" type="reset">Reset</button>
                                        </div>
                                    </div>
                  </div>
                  {!! csrf_field() !!}
                </form>
              </div>
            </div>
         </div>
         </div>
      </div>
   </div>
</div>
@endsection

<!-- Footer JavaScript -->
@section('footer-js')
<script type="text/javascript">
    $(document).ready(function() {

        //view successful/fail message on submission of the add-quote form
        @if ($message == 'success')

            swal({
                    title: 'Success',
                    text: 'Quote added successfully',
                    type: 'success',
                    showConfirmButton: true,
                    confirmButtonText: 'View'
                },

                function(isConfirm){
                    if (isConfirm) {
                        window.location.href = "http://www.planmyevent.me/dashboard/quote-requests";
                    }
                });

        @elseif ($message == 'fail')

            swal({
            title: 'Fail',
            text: 'Quote submission failed',
            type: 'error',
            showConfirmButton: false,
            showCancelButton: true,
            cancelButtonText: 'Cancel'
        });

        @endif

});
</script>

<script type="text/javascript">

    $('#cost\\[\\]').keyup(function () {

        // initialize the sum (total price) to zero
        var sum = 0;
        var downpayment = 0;
        var total = 0;

        // we use jQuery each() to loop through all the textbox with 'price' class
        // and compute the sum for each loop
        $('#cost\\[\\]').each(function() {
            sum += Number($(this).val());
            downpayment = sum*40/100;
            total = sum - downpayment;
        });

        // set the computed value to 'totalPrice' textbox


        $('#subtotal').val(sum.toFixed(2));
        $('#downpayment').val(downpayment.toFixed(2));
        $('#totalpay').val(total.toFixed(2));

    });



</script>

@endsection