{{-- Home Page --}}

@extends('master')

@section('content')
<div class="content">
    <div class="container">
		<div class="row">
		    <!-- Calendar -->
		    <div class="col-md-12">
		        <div class="panel panel-default">
		            <div class="panel-body">
		                <div class="row">
		                    <div class="col-md-12 col-sm-12 col-xs-12">
		                        <div id="calendar"><h3 style="text-align: center;"><span id="calLoad">Loading...</span></h3></div>
		                    </div>
		                </div>
		            </div>
		        </div>
		    </div>
		</div>
	</div>
</div>
@endsection

@section('jquery')
    $('#calendar').fullCalendar( 'changeView', 'agendaWeek');
@endsection

@section('footer-js')

<script>var VIEW = 'AGENDA_WEEK';</script>

<!-- Calendar -->
<script src="{{asset('assets/fullcalendar/moment.min.js')}}"></script>
<script src="{{asset('assets/fullcalendar/fullcalendar.min.js')}}"></script>
<script src="{{asset('assets/fullcalendar/fullcalendar.js')}}"></script>

@endsection