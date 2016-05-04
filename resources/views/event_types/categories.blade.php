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
        <?php if(Session::get('message')=='Record Update Failed') {echo 'sweetAlert("Oops...", "You forgot to add some elements.", "error");';} else { echo 'sweetAlert("'.Session::get('message').'", "Your record is updated...", "success");';} ?>
    }

@if(Session::has('message'))
    window.onload  = function() {
        init2(); };
        $(window).resize();
@endif       

<?php
                        switch (session()->get('user_role')){
                            case "customer":
                                $userRole = "Customer";
                                break;

                            case "admin":
                                $userRole = "Administrator";
                                break;

                            case "event-planner":
                                $userRole = "Event Planner";
                                break;

                            case "team-member":
                                $userRole = "Team Member";
                                break;

                            default:
                                $userRole = "Unknown User";
                        }
                    ?>        
})();

</script>

<div class="row">
    <div class="col-sm-12">
        <h4 class="pull-left page-title">Event Categories</h4>
        @if ($userRole == "Administrator") <a href="{{ url('dashboard/request-a-quote') }}" class=""> 
        <ol class="breadcrumb pull-right">
            <a href="{{ url('dashboard/events/categories/add') }}"> <button class="btn btn-success waves-effect waves-light" id="btnsub" >Add New</button></a>
        </ol>          
        @endif       
    </div>
</div>

<div  class="eventtypescontainer">
<?php 
	//reate arrays to store data
	$types = array();
    $icons = array();
    $slugs = array();

    //use the recieved data from controller to display info
	foreach($EventTypeQuery  as $x) {
	    $types[] = $x->EventName;
        $icons[] = $x->Icon;
        $slugs[] = $x->EventSlug;
	}
    use App\Models\Event_Services;
    use App\Models\Services;

foreach($types as $y => $y_value)
{
?>
 @if ($userRole == "Customer") <a href="{{ url('dashboard/request-a-quote') }}" class=""> @endif       
    <div class="etypes col-sm-6 col-md-6 col-lg-3" style="height: 440px;">
        <div class="pricing-item">
            <div class="pricing-item-inner">
                <div class="pricing-wrap">     
                        
                    <div class="pricing-icon">
                    <?php 
                        $imgurl = $icons[$y];
                        $slug = $slugs[$y];
                    ?>
                    <img src="{{asset('images/event-icons').'/'.$imgurl}}"  onError="this.onerror=null;this.src='{{asset('images/event-icons/na.png')}}';" height="50" width="50">
                         

                    </div>
                                
                    <div class="pricing-title">
                          {{$y_value}}
                        
                    </div>
                                
                    <div style="height: 86px;" class="pricing-features">

						<ul class="sf-list pr-list">
						<?php
						
                        //choose the corresponding services in the event type
						$ServicesQuery = Event_Services::select('*')->where('EventName', $y_value)->get();;
						if ($ServicesQuery!=null) 
                        {
    						foreach($ServicesQuery as $service) 
                            {
                                $serv = $service->Service;
                                $description = Services::select('*')->where('Service',$serv)->get();
                                //$desc = $description->Description;
                                //echo '<li>';
                                foreach($description as $d)
                                {
                                    $desc=$d->Description;
                                }
    							echo "<li  style='padding:2px 20px' title='".$desc."' >".$service->Service."</li>";
                                //echo '</li>';
    						}
    					}

					   ?>
                        </ul>
                    </div>
                                        
                                    
                    <div class="pr-button">
                        <form method="get" action="categories/edit">
                            <input  hidden type="text" name="EventName" id="EventName" value="<?php echo $y_value ;?>">

                            @if ($userRole == "Administrator" || $userRole == "Event Planner") 
                            <button style="margin-top:5px" type ="submit" class="btn btn-success w-md waves-effect waves-light">Edit Services</button>
                            <?php echo '<a href ="../question-builder?category='.$slug.'"  style="margin-top:5px" class="btn btn-success w-md waves-effect waves-light">Edit Questions</a>';?>
                            <?php echo '<a href ="../events/categories/tasks/edit?EventName='.$y_value.'"  style="margin-top:5px" class="btn btn-success w-md waves-effect waves-light">Edit Tasks</a>';?>
                            @endif

                            @if ($userRole == "Customer") 
                            <?php echo '<a href="#"  style="margin-top:5px" class="btn btn-success w-md waves-effect waves-light">Select Event</a>';?>
                            @endif

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
 @if ($userRole == "Customer") </a> @endif   
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