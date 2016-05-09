@extends('master-web')

@section('content')

<!-- Page Title
		============================================= -->
		<section id="page-title">

			<div class="container clearfix">
				<h1>Contact</h1>
				<span>Get in Touch with Us</span>
				<ol class="breadcrumb">
					<li><a href="#">Home</a></li>
					<li class="active">Contact</li>
				</ol>
			</div>

		</section><!-- #page-title end -->


		<!-- Contact Form & Map Overlay Section
		============================================= -->
		<section id="map-overlay">

			<div class="container clearfix">

				<!-- Contact Form Overlay
				============================================= -->
				<div id="contact-form-overlay" class="clearfix">

					<div class="fancy-title title-dotted-border">
						<h3>Send us an Email</h3>
					</div>

					<div class="contact-widget">

						<div class="contact-form-result"></div>

						<!-- Contact Form
						============================================= -->
						<form class="nobottommargin" action="/contact-us" method="post">
							{!! csrf_field() !!}
							<div class="col_half">
								<label for="template-contactform-name">Name <small>*</small></label>
								<input type="text" id="template-contactform-name" name="name" value="" class="sm-form-control required" />
							</div>

							<div class="col_half col_last">
								<label for="template-contactform-email">Email <small>*</small></label>
								<input type="email" id="template-contactform-email" name="email" value="" class="required email sm-form-control" />
							</div>

							<div class="clear"></div>

							<div class="col_half">
								<label for="template-contactform-phone">Phone</label>
								<input type="text" id="template-contactform-phone" name="phone" value="" class="sm-form-control" />
							</div>

							<div class="col_half col_last">
								<label for="template-contactform-service">Interested Event Type</label>
								<select id="template-contactform-service" name="service" class="sm-form-control">
									<option value="">-- Select One --</option>
									<?php 

									foreach($eventCatlist as $cat)
                                    {

                                   	?>
									<option value="{{ $cat->EventName }}">{{ $cat->EventName }}</option>
									
									<?php } ?>
								</select>
							</div>

							<div class="clear"></div>

							<div class="col_full">
								<label for="template-contactform-subject">Subject <small>*</small></label>
								<input type="text" id="template-contactform-subject" name="subject" value="" class="required sm-form-control" />
							</div>

							<div class="col_full">
								<label for="template-contactform-message">Message <small>*</small></label>
								<textarea class="required sm-form-control" id="template-contactform-message" name="message" rows="6" cols="30"></textarea>
							</div>

							<div class="col_full">
								<input class="button button-3d nomargin" type="submit" value="submit" />
							</div>

						</form>
					</div>


					<div class="line"></div>

					<!-- Contact Info
					============================================= -->
					<div class="col_one_third nobottommargin">

						<address>
							<strong>Location:</strong><br>
							No. 516,<br>
							Galle Road,<br>
							Colombo 03,<br>
							Sri Lanka.
						</address>

					</div><!-- Contact Info End -->

					<div class="col_one_third nobottommargin">
						<abbr title="Phone Number"><strong>Phone:</strong></abbr> +(94) 766 987 229<br>
						<abbr title="Fax"><strong>Fax:</strong></abbr> +(94) 112 987 229<br>
						<abbr title="Email Address"><strong>Email:</strong></abbr> info@planmyevent.me

					</div><!-- Contact Info End -->


				</div><!-- Contact Form Overlay End -->

			</div>

			<!-- Google Map
			============================================= -->
			<section id="google-map" class="gmap"></section>


		</section><!-- Contact Form & Map Overlay Section End -->

@endsection


@section('footer-js')
	<script type="text/javascript" src="https://maps.google.com/maps/api/js"></script>
	<script type="text/javascript" src="{{ asset('assets/website/js/jquery.gmap.js') }}"></script>

	<script type="text/javascript">

		$('#google-map').gMap({
			address: 'Malabe, Sri Lanka',
			maptype: 'ROADMAP',
			zoom: 16,
			doubleclickzoom: false,
			controls: {
				panControl: true,
				zoomControl: true,
				mapTypeControl: true,
				scaleControl: false,
				streetViewControl: false,
				overviewMapControl: false
			}
		});
	</script>
@endsection