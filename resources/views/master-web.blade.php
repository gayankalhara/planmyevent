<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />

    <!-- Stylesheets
    ============================================= -->
    <link href="http://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Montserrat:400,700|Crete+Round:400italic" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{asset('assets/website/css/bootstrap.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{asset('assets/website/style.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{asset('assets/website/css/swiper.css')}}" type="text/css" />


    <link rel="stylesheet" href="{{asset('assets/website/css/dark.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{asset('assets/website/css/font-icons.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{asset('assets/website/css/animate.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{asset('assets/website/css/magnific-popup.css')}}" type="text/css" />
    
    <link rel="stylesheet" href="{{asset('css/material-design-iconic-font.min.css')}}" type="text/css" />

    <link rel="stylesheet" href="{{asset('assets/website/css/responsive.css')}}" type="text/css" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!--[if lt IE 9]>
        <script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
    <![endif]-->

    <link rel="stylesheet" href="{{asset('assets/website/css/colors.php?color=1D81BB')}}" type="text/css" />


    <!-- SLIDER REVOLUTION 5.x CSS SETTINGS -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/website/include/rs-plugin/css/settings.css')}}" media="screen" />
    <link rel="stylesheet" type="text/css" href="{{asset('assets/website/include/rs-plugin/css/layers.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/website/include/rs-plugin/css/navigation.css')}}">


    <!-- Document Title
    ============================================= -->
    <title>Plan My Event</title>

    <style>
        .form-control.error { border: 2px solid red; }
    </style>

    <style>

        .demos-filter {
            margin: 0;
            text-align: right;
        }

        .demos-filter li {
            list-style: none;
            margin: 10px 0px;
        }

        .demos-filter li a {
            display: block;
            border: 0;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #444;
        }

        .demos-filter li a:hover,
        .demos-filter li.activeFilter a { color: #1ABC9C; }

        @media (max-width: 991px) {
            .demos-filter { text-align: center; }

            .demos-filter li {
                float: left;
                width: 33.3%;
                padding: 0 20px;
            }
        }

        @media (max-width: 767px) {
            .demos-filter li { width: 50%; }
        }

        .revo-slider-emphasis-text {
            font-size: 64px;
            font-weight: 700;
            letter-spacing: -1px;
            font-family: 'Raleway', sans-serif;
            padding: 15px 20px;
            border-top: 2px solid #FFF;
            border-bottom: 2px solid #FFF;
        }

        .revo-slider-desc-text {
            font-size: 20px;
            font-family: 'Lato', sans-serif;
            width: 650px;
            text-align: center;
            line-height: 1.5;
        }

        .revo-slider-caps-text {
            font-size: 16px;
            font-weight: 400;
            letter-spacing: 3px;
            font-family: 'Raleway', sans-serif;
        }
        .tp-video-play-button { display: none !important; }

        .tp-caption { white-space: nowrap; }

    </style>
</head>

<body class="stretched no-transition">
    <!-- Document Wrapper
    ============================================= -->
    <div id="wrapper" class="clearfix">

        <!-- Top Bar
        ============================================= -->
        <div id="top-bar">

            <div class="container clearfix">

                <div class="col_half hidden-xs nobottommargin">

                    <!-- Top Links
                    ============================================= -->
                    <div class="top-links">
                        <ul>
                            <li><a href="#"><i class="icon-phone3"></i> +94 766 987 229</a></li>
                            <li><a href="#" class="nott"><i class="icon-envelope2"></i> hello@planmyevent.me</a></li>
                        </ul>
                    </div><!-- .top-links end -->

                </div>

                <div class="col_half col_last fright nobottommargin">

                    <!-- Top Links
                    ============================================= -->
                    <div class="top-links">
                        @if(Auth::check())
                        <ul>
                            <li><a href="{{ url('/dashboard') }}" style="background-color: #46B304; color:#fff;">Go to Dashboard</a></li>
                        </ul>
                        @else
                        <ul>
                            <li><a href="{{ url('/login') }}" style="background-color: #46B304; color:#fff;">Login</a></li>
                            <li><a href="{{ url('/register') }}" class="bgcolor" style="color:#fff;">Register</a></li>
                        </ul>
                        @endif
                    </div><!-- .top-links end -->

                </div>

            </div>

        </div><!-- #top-bar end -->

        <!-- Header
        ============================================= -->
        <header id="header">

            <div id="header-wrap">

                <div class="container clearfix">

                    <div id="primary-menu-trigger"><i class="icon-reorder"></i></div>

                    <!-- Logo
                    ============================================= -->
                    <div id="logo">
                        <a href="index.html" class="standard-logo"><img src="{{asset('assets/website/logo.png')}}" alt="Canvas Logo"></a>
                        <a href="index.html" class="retina-logo"><img src="{{asset('assets/website/logo@2x.png')}}" alt="Canvas Logo"></a>
                    </div><!-- #logo end -->

                    <!-- Primary Navigation
                    ============================================= -->
                    <nav id="primary-menu" class="style-3">

                        <ul>
                            <li class="{{ Request::is('/') ? 'current' : null }}"><a href="{{ url('/') }}"><div>Home</div></a></li>
                            <li class="{{ Request::is('about-us') ? 'current' : null }}"><a href="#"><div>About Us</div></a></li>
                            <li class="{{ Request::is('our-services') ? 'current' : null }}"><a href="#"><div>Our Services</div></a></li>
                            <li class="{{ Request::is('features') ? 'current' : null }}"><a href="#"><div>Features</div></a></li>
                            <li class="{{ Request::is('gallery') ? 'current' : null }}"><a href="#"><div>Gallery</div></a></li>
                            <li class="{{ Request::is('faq') ? 'current' : null }}"><a href="#"><div>FAQ</div></a></li>
                            <li class="{{ Request::is('contact-us') ? 'current' : null }}"><a href="{{ url('/contact-us') }}"><div>Contact Us</div></a></li>
                        </ul>

                    </nav><!-- #primary-menu end -->

                </div>

            </div>

        </header><!-- #header end -->

        @yield('content')

        <!-- Footer
        ============================================= -->
        <footer id="footer" style="background-color: #F5F5F5;border-top: 2px solid rgba(0,0,0,0.06);">

            <div class="container" style="border-bottom: 1px solid rgba(0,0,0,0.06);">

                <!-- Footer Widgets
                ============================================= -->
                <div class="footer-widgets-wrap clearfix">

                    <div class="col_two_third">

                        <div class="widget clearfix">

                            <div class="widget-subscribe-form-result"></div>
                            <form id="widget-subscribe-form" action="include/subscribe.php" role="form" method="post" class="nobottommargin row clearfix">
                                <div class="col-md-9">
                                    <input type="email" id="widget-subscribe-form-email" name="widget-subscribe-form-email" class="sm-form-control required email" placeholder="Enter your Email to get special package discounts">
                                </div>
                                <div class="col-md-3">
                                    <button class="button button-rounded nomargin center btn-block" type="submit">Subscribe</button>
                                </div>
                            </form>

                            <div class="line line-sm"></div>

                            <div class="row">
                                <div class="clear-bottommargin-sm clearfix">

                                    <div class="col-md-3 col-xs-6 bottommargin-sm widget_links">
                                        <ul>
                                            <li><a href="{{ url('/') }}">Home</a></li>
                                            <li><a href="#">About</a></li>
                                            <li><a href="#">FAQs</a></li>
                                            <li><a href="#">Support</a></li>
                                            <li><a href="{{ url('/contact-us') }}">Contact Us</a></li>
                                        </ul>
                                    </div>

                                    <div class="col-md-3 col-xs-6 bottommargin-sm widget_links">
                                        <ul>
                                            <li><a href="#">Our Services</a></li>
                                            <li><a href="#">Service Providers</a></li>
                                            <li><a href="#">Client Testimonials</a></li>
                                            <li><a href="#">Event Gallery</a></li>
                                            <li><a href="#">Features</a></li>
                                        </ul>
                                    </div>

                                    <div class="col-md-3 col-xs-6 bottommargin-sm widget_links">
                                        <ul>
                                            <li><a href="#">Weddings</a></li>
                                            <li><a href="#">Birthday Parties</a></li>
                                            <li><a href="#">Conference Meetings</a></li>
                                            <li><a href="#">Seminars</a></li>
                                            <li><a href="#">Product Launches</a></li>
                                        </ul>
                                    </div>

                                    <div class="col-md-3 col-xs-6 bottommargin-sm widget_links">
                                        <ul>
                                            <li><a href="#">Press Conferences</a></li>
                                            <li><a href="#">Board Meetings</a></li>
                                            <li><a href="#">Trade Shows</a></li>
                                            <li><a href="#">Anniversaries</a></li>
                                            <li><a href="#">Family Events</a></li>
                                        </ul>
                                    </div>

                                </div>
                            </div>

                        </div>

                    </div>

                    <div class="col_one_third col_last">

                        <div class="widget clear-bottommargin-sm clearfix">

                            <div class="row">

                                <div class="col-md-12 bottommargin-sm">
                                    <div class="footer-big-contacts">
                                        <span>Call Us:</span>
                                        (+94) 766 987 229
                                    </div>
                                </div>

                                <div class="col-md-12 bottommargin-sm">
                                    <div class="footer-big-contacts">
                                        <span>Send an Email:</span>
                                        <a href="mailto:hello@planmyevent.me">hello@planmyevent.me</a>
                                    </div>
                                </div>

                            </div>

                        </div>

                        <div class="widget subscribe-widget clearfix">
                            <div class="row">

                                <div class="col-md-6 clearfix bottommargin-sm">
                                    <a href="#" class="social-icon si-dark si-colored si-facebook nobottommargin" style="margin-right: 10px;">
                                        <i class="icon-facebook"></i>
                                        <i class="icon-facebook"></i>
                                    </a>
                                    <a href="#"><small style="display: block; margin-top: 3px;"><strong>Like us</strong><br>on Facebook</small></a>
                                </div>
                                <div class="col-md-6 clearfix">
                                    <a href="#" class="social-icon si-dark si-colored si-twitter nobottommargin" style="margin-right: 10px;">
                                        <i class="icon-twitter"></i>
                                        <i class="icon-twitter"></i>
                                    </a>
                                    <a href="#"><small style="display: block; margin-top: 3px;"><strong>Follow us</strong><br>on Twitter</small></a>
                                </div>

                            </div>
                        </div>

                    </div>

                </div><!-- .footer-widgets-wrap end -->

            </div>

            <!-- Copyrights
            ============================================= -->
            <div id="copyrights" class="nobg">

                <div class="container clearfix">

                    <div class="col_half">
                        Copyrights &copy; 2016 Sri Lanka Institute of Information Technology. All rights reserved.<br>
                        <div class="copyright-links"><a href="#">Terms and Conditions</a> / <a href="#">Privacy Policy</a> / <a href="#">Usage of Cookies</a></div>
                    </div>

                    <div class="col_half col_last tright">
                        <div class="copyrights-menu copyright-links clearfix">
                            <a href="#">Home</a>/<a href="#">About Us</a>/<a href="#">Team</a>/<a href="#">Clients</a>/<a href="#">FAQs</a>/<a href="#">Contact</a>
                        </div>
                    </div>

                </div>

            </div><!-- #copyrights end -->

        </footer><!-- #footer end -->

    </div><!-- #wrapper end -->

    <!-- Go To Top
    ============================================= -->
    <div id="gotoTop" class="icon-angle-up"></div>

    <!-- External JavaScripts
    ============================================= -->
    <script type="text/javascript" src="{{asset('assets/website/js/jquery.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/website/js/plugins.js')}}"></script>

    @yield('footer-js')

    <!-- Footer Scripts
    ============================================= -->
    <script type="text/javascript" src="{{asset('assets/website/js/functions.js')}}"></script>

    
</body>