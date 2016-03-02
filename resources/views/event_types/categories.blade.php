@extends('master')
@section('header-css')

@endsection
@section('header-js')

@endsection
@section('content')
<div class="content">
<div class="container">

<script>

    var ModalEffects = (function() 
    {

    function init2() 
    {
        <?php if(Session::get('message')=='Record Update Failed') {echo 'sweetAlert("Oops...", "You forgot to add some elements.", "error");';} else { echo 'sweetAlert("Updated successfully!", "Your record is updated...", "success");';} ?>
    }

@if(Session::has('message'))
    window.onload  = function() {
        init2(); };
        $(window).resize();
@endif       
        
})();


</script>

<div class="row">
    <div class="col-sm-12">
        <h4 class="pull-left page-title">Event Categories</h4>
        <ol class="breadcrumb pull-right">
            <a href="{{ url('/events/categories/add') }}"> <button class="btn btn-success waves-effect waves-light" id="btnsub" >Add New</button></a>
        </ol>          
        <ol hidden>
            <li><a href="javascript:;" class="md-trigger2" style="font-family: 'Nunito', sans-serif;" data-modal="data-modal-add"><i class="md md-loop"></i> Click Here</a></li>
        </ol>
    </div>
</div>
<div class="eventtypescontainer">
<?php 
	$EventTypeQuery = DB::select('SELECT EventName FROM event_types') ;
	$types = array();
	foreach($EventTypeQuery  as $x) {
	    $types[] = $x->EventName;
        
	}

foreach($types as $y => $y_value)
{
?>

    <div class="etypes col-sm-6 col-md-6 col-lg-3" style="height: 370px;">
        <div class="pricing-item">
            <div class="pricing-item-inner">
                <div class="pricing-wrap">     
                                <!-- Icon (Simple-line-icons) -->
                    <div class="pricing-icon">
                    <?php 
                    $IconQuery = DB::select('SELECT Icon From event_types where EventName = ? and Icon is not null' , [$y_value]) ;
                    foreach($IconQuery as $iconite)
                        $imgurl = $iconite->Icon;
                    ?>
                    <img src="{{asset('images/event-icons').'/'.$imgurl}}" alt="N/A" onError="this.onerror=null;this.src='{{asset('images/event-icons/na.png')}}';" height="50" width="50">
                         

                    </div>
                                <!-- Pricing Title -->
                    <div class="pricing-title">
                        <?php echo $y_value;?>
                    </div>
                                <!-- Pricing Features -->  
                    <div style="height: 86px;" class="pricing-features">

						<ul class="sf-list pr-list">
						<?php
						
                        $ServicesQuery = DB::select('SELECT Service FROM event_services where EventName = ?', [$y_value]);
						
						if ($ServicesQuery!=null) {
    						foreach($ServicesQuery as $service) {
    							echo "<li style='padding:2px 20px'>".$service->Service."</li>";
    						}
    					}

					   ?>
                        </ul>
                    </div>
                                        
                                <!-- Button -->                     
                    <div class="pr-button">
                    <form method="get" action="/events/categories/edit">
                    <input hidden type="text" name="EventName" id="EventName" value="<?php echo $y_value ;?>">
                        <button type ="submit" class="btn btn-success w-md waves-effect waves-light">Edit</button>
                    <?php $EventSlugQuery = DB::select('SELECT EventSlug FROM event_types where EventName = ?' , [$y_value]) ;
                        foreach($EventSlugQuery as $islug)
                        $slug = $islug->EventSlug;
                    ?>

                    <?php echo '<a href ="../question-builder?category='.$slug.'" ><button class="btn btn-success w-md waves-effect waves-light">Edit Questions</button></a>';?>



                    </form>


                    </div>
                </div>
            </div>
        </div>
    </div>

<?php
}
?>
</div>
</div>
</div>
                      <!-- End Pricing Item -->
        
        @endsection
@section('footer-css')

@endsection

@section('footer-js')
  <script src="{{asset('assets/modal-effect/js/classie.js')}}"></script>      
@endsection
@section('jquery')

@endsection