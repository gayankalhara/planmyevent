@extends('master')
@section('header-css')

@endsection
@section('header-js')
@endsection
@section('content')
<div class="content">
<div class="container">

<script>


/**
* Theme: Moltran Admin Template
* Author: Coderthemes
* SweetAlert - 
* Usage: $.SweetAlert.methodname
*/
E = function(t) {
  var n = t || e.event,
    o = n.target || n.srcElement,
    r = -1 !== o.className.indexOf("confirm"),
    s = C(B, "visible"),
    i = g.doneFunction && "true" === B.getAttribute("data-has-done-function");
  switch (n.type) {
    case "mouseover":
      r && (o.style.backgroundColor = a(g.confirmButtonColor, -.04));
      break;
    case "mouseout":
      r && (o.style.backgroundColor = g.confirmButtonColor);
      break;
    case "mousedown":
      r && (o.style.backgroundColor = a(g.confirmButtonColor, -.14));
      break;
    case "mouseup":
      r && (o.style.backgroundColor = a(g.confirmButtonColor, -.04));
      break;
    case "focus":
      var c = B.querySelector("button.confirm"),
        l = B.querySelector("button.cancel");
      r ? l.style.boxShadow = "none" : c.style.boxShadow = "none";
      break;
    case "click":
      if (r && i && s) g.doneFunction(!0), g.closeOnConfirm && v.close();
      else if (i && s) {
        var u = String(g.doneFunction).replace(/\s/g, ""),
          f = "function(" === u.substring(0, 9) && ")" !== u.substring(9, 10);
        f && g.doneFunction(!1), g.closeOnCancel && v.close()
      } else v.close()
  }
}
!function($) {
    "use strict";

    var SweetAlert = function() {};

    //examples 
    SweetAlert.prototype.init = function() {
        

    //Success Message
    $('#body').load(function(){
        swal("Good job!", "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed lorem erat, tincidunt vitae ipsum et, pellentesque maximus enim. Mauris eleifend ex semper, lobortis purus sed, pharetra felis", "success")
    });


    $('#body').load(function(){
         swal({   
            title: "Auto close alert!",   
            text: "I will close in 2 seconds.",   
            timer: 2000,   
            showConfirmButton: false 
        });
    });


    },
    //init
    $.SweetAlert = new SweetAlert, $.SweetAlert.Constructor = SweetAlert
}(window.jQuery),

//initializing 
function($) {
    "use strict";
    $.SweetAlert.init()
}(window.jQuery);


</script>




<div hidden class="btn btn-success waves-effect waves-light btn-sm" id="sa-close"></div>

<div style="display: block;" data-timer="2000" data-animation="pop" data-has-done-function="false" data-allow-ouside-click="false" data-has-confirm-button="false" data-has-cancel-button="false" data-custom-class="" class="sweet-alert" tabindex="-1">
    <div style="display: none;" class="sa-icon sa-error">
        <span class="sa-x-mark"><span class="sa-line sa-left"></span>
        <span class="sa-line sa-right"></span></span>
    </div>
    
    <div style="display: none;" class="sa-icon sa-warning"> 
    <span class="sa-body"></span> 
    <span class="sa-dot"></span> 
    </div> 
    
    <div style="display: none;" class="sa-icon sa-info">
    </div> 
    
    <div style="display: none;" class="sa-icon sa-success"> 
        <span class="sa-line sa-tip"></span> 
        <span class="sa-line sa-long"></span> 
    
        <div class="sa-placeholder">
        </div> 
        <div class="sa-fix">
        </div> 
    
    </div> 
    
    <div style="display: none;" class="sa-icon sa-custom">
    </div> 
    <h2>Auto close alert!</h2>
    
    <p style="display: block;">I will close in 2 seconds.</p>
    
    <button style="display: none;" class="cancel" tabindex="2">Cancel</button>
    <button style="display: none; background-color: rgb(174, 222, 244); box-shadow: 0px 0px 2px rgba(174, 222, 244, 0.8), 0px 0px 0px 1px rgba(0, 0, 0, 0.05) inset;" class="confirm" tabindex="1">OK</button>
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