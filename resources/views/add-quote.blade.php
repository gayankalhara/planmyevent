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
            <input type="text" id="taskcount" name="taskcount" value="@foreach( $result as $quote){{$task = $quote->TaskCount}} @endforeach" hidden>
      <div class="row">
         <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default"> 
              <div class="panel-body"> 
                <label>Event ID:</label>
                <label>@foreach( $result as $quote){{$quote->id}} @endforeach</label>
                <br/>
                <label>Event Type:</label>
                <label>@foreach( $result as $quote){{$quote->EventType}} @endforeach</label>
                <br/>
                <label>Services:</label>
                <label id="tasklist">{{$services}}</label>
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
                <form class="form-horizontal" id="" method="post" action="" >
                  <div>
                  <?php
                      $serviceList = explode(", ", $services);
                  ?>
                  <?php
                       for ($i=1; $i <=$task; $i++)

                              {
                                  echo '<div class="form-group ">
                                  <label for="firstname" class="control-label col-lg-4">'.$serviceList[$i-1].' (Rs.)</label>
                                  <div class="col-lg-6">
                                  <input class=" form-control" id="totalpay" name="totalpay" type="text" required
>
                              </div>
                                        </div>';

                         }

                ?>
                  <hr>
                  <div class="form-group ">
                        <label for="firstname" class="control-label col-lg-4">Sub Total (Rs.)</label>
                              <div class="col-lg-6">
                                            <input class=" form-control" id="totalpay" name="totalpay" type="text" required>
                      </div>
                    </div>
                    <div class="form-group ">
                        <label for="firstname" class="control-label col-lg-4">Down Payment (Rs.)</label>
                              <div class="col-lg-6">
                                            <input class=" form-control" id="totalpay" name="totalpay" type="text" required>
                      </div>
                    </div>
                    <div class="form-group ">
                        <label for="firstname" class="control-label col-lg-4">Total Payable (Rs.)</label>
                              <div class="col-lg-6">
                                            <input class=" form-control" id="totalpay" name="totalpay" type="text" required>
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
                    <div class="form-group ">
                                        <div class="col-lg-offset-3 col-lg-9">
                                            <button class="btn btn-success waves-effect waves-light" type="submit">Save</button>
                                            <button class="btn btn-default waves-effect" type="button">Cancel</button>
                                            <button class="btn btn-default waves-effect" id="demo" name="demo" type="button">Demo</button>
                                        </div>
                                    </div>
                  </div>
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

    });
</script>


@endsection