@extends('master')

@section('content')
<div class="content">
<div class="container">

<script>

    var ModalEffects = (function() 
    {

    function init2() 
    {

        var overlay = document.querySelector( '.md-overlay' );

        [].slice.call( document.querySelectorAll( '.md-trigger2' ) ).forEach( function( el, i ) 
        {

            var modal = document.querySelector( '#' + el.getAttribute( 'data-modal' ) ),
            close = modal.querySelector( '.md-close' );
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

        } );
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
<<<<<<< HEAD
            <a href="{{ url('dashboard/events/categories/add') }}"> <button class="btn btn-success waves-effect waves-light" id="btnsub" >Add New</button></a>
=======
            <a href="{{ url('/events/categories/add') }}"> <button class="btn btn-success waves-effect waves-light" id="btnsub" >Add New</button></a>
>>>>>>> e29ccdd27609c0470752dbc32f2bca356375a512
        </ol>          
        <ol hidden>
            <li><a href="javascript:;" class="md-trigger2" style="font-family: 'Nunito', sans-serif;" data-modal="data-modal-add"><i class="md md-loop"></i> Click Here</a></li>
        </ol>
    </div>
</div>

<?php 
//$sql = "SELECT distinct EventName FROM event_types";
//$servername = "localhost";
//$username = "root";
//$password = "";
//$dbname = "sep";

// Create connection
$conn = new mysqli('localhost', 'root', '', 'sep');
// Check connection
	$sql = "SELECT distinct EventName FROM event_types";
	$result = $conn->query($sql) ;
	$result2 = DB::select('SELECT distinct EventName FROM event_types') ;
	$types = array();
	foreach($result2  as $x) {
	    $types[] = $x->EventName;
	}


foreach($types as $y => $y_value)
{
?>

    <div class="col-sm-6 col-md-6 col-lg-3" style="height: 370px;">
        <div class="pricing-item">
            <div class="pricing-item-inner">
                <div class="pricing-wrap">     
                                <!-- Icon (Simple-line-icons) -->
                    <div class="pricing-icon">
                    <?php 
                    
                    // $result3 = DB::select('SELECT Icon From event_types where Icon is not null and EventName = ?', ['$y_value']);
					$sql2 = "SELECT Icon From event_types where EventName = '".$y_value."' and Icon is not null";
					$result3 = $conn->query($sql2);
						if ($result3->num_rows > 0) {
    						while($row2 = $result3->fetch_assoc()) {
                               $imgurl=$row2['Icon'];
    						}
    					}
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
						$sql = "SELECT Task FROM event_types where EventName = '".$y_value."'";
						$result = $conn->query($sql) ;
						if ($result->num_rows > 0) {
    						while($row = $result->fetch_assoc()) {
    							echo "<li style='padding:2px 20px'>".$row["Task"]."</li>";
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
                    </form>


                    </div>
                </div>
            </div>
        </div>
    </div>

<?php
}
?>
    <div  class="md-modal md-effect-11" id="data-modal-add">
        <div class="md-content" <?php if(Session::get('message')=='Record Update Failed') {echo 'style="background-color: #ff3333 ;"';} else { echo 'style="background-color:#2379CE;"';} ?>>
            
            <div style="color: #fff;">
            <h2 style="color: #fff; text-align: center;">Message</h2>
                <p style="text-align: center;">{{ Session::get('message') }}</p>
                
                <div class="row" style="margin-top: 15px; margin-bottom: 20px;">
                            
                </div>

                <div class="row" style="text-align: center;"><button class="md-close btn-sm btn-inverse waves-effect waves-light">Close</button></div>
            </div>
        </div>
    </div>
</div>
</div>
                      <!-- End Pricing Item -->
        <script src="{{asset('assets/modal-effect/js/classie.js')}}"></script>
        
@endsection