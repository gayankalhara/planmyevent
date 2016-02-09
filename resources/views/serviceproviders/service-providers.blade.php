<!-- Load the master page -->
@extends('master')

<!-- Header CSS -->
@section('header-css')
    <link href="{{asset('assets/datatables/jquery.dataTables.min.css')}}" rel="stylesheet" type="text/css" />
@endsection

<!-- Header JavaScript -->
@section('header-js')
    
@endsection

<!-- Header Content -->
@section('content')
 <div class="content">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h4 class="pull-left page-title">Service Providers</h4>
                
                <ol class="breadcrumb pull-right">
                       <a href="{{ url('/service-providers/add') }}"> <button class="btn btn-success waves-effect waves-light" id="btnsub" type="submit">Add New</button></a>
                </ol>
                
                <ol hidden>
                    <li><a href="javascript:;" class="md-trigger2" style="font-family: 'Nunito', sans-serif;" data-modal="data-modal-add"><i class="md md-loop"></i> Click Here</a></li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <table id="datatable" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Company Name</th>
                                            <th>Service</th>
                                            <th>Address</th>
                                            <th>Telephone No</th>
                                            <th>Email</th>
                                            <th>Edit</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php $result = DB::select('SELECT * FROM services') ;

                                        foreach($result as $sevice)
                                        {
                                            echo '<tr>';
                                            echo '<td>'.$sevice->CompanyName.'</td>';
                                            echo '<td>'.$sevice->Service.'</td>';
                                            echo '<td>'.$sevice->Address.'</td>';
                                            echo '<td>'.$sevice->TelNo.'</td>';
                                            echo '<td>'.$sevice->Email.'</td>';
                                            echo '<td><a href ="service-providers/edit?CompanyName='.$sevice->CompanyName.'&Service='.$sevice->Service.'" ><i class="fa fa-edit"></i></td>';
                                            ?> 
                                            
                                            <?php
                                            echo '</tr>';
                                        }
                                                
                                        ?>
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> 

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
@endsection
     
<!-- Footer JavaScript -->
@section('footer-js')

    <script type="text/javascript">
            $(document).ready(function() {
                $('#datatable').dataTable();
            } );
    </script>


    <script src="{{asset('assets/modal-effect/js/classie.js')}}"></script>

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

    <script src="{{asset('assets/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/datatables/dataTables.bootstrap.js')}}"></script>
@endsection