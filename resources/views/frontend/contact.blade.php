@extends('frontend.layouts.app')
@section('content')
<!-- Breadcumb area Start -->
<div class="breadcrumb-area">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="page-title">Contact Us</h1>
                <ul class="breadcrumb justify-content-center">
                    <li><a href="#">Home</a></li>
                    <li class="current"><a href="#">Contact</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- Breadcumb area End -->

<!-- Main Wrapper Start -->
<div class="main-content-wrapper">
    <!-- Google Map Start -->
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d463944.9400402963!2d46.46390088984788!3d24.707309595907006!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x15e7b33fe7952a41%3A0x5960504bc21ab69b!2sSaudi%20Arabia!5e0!3m2!1sen!2sin!4v1593320285024!5m2!1sen!2sin" width="100%" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
    <!-- Google Map End -->

    <!-- Contact Area Start -->
    <div class="contact-area ptb--80 ptb-md--60">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2 class="heading-secondary border-bottom mb--30">CONTACT US</h2>
                    @if(Session::has('success'))
				      	<div class="alert alert-success">
				        	{!! session('success') !!}
				      	</div>
			      	@endif
                    <form class="form form--contact" method="POST"  action="{!! route('send.enquiry') !!}">
                        @csrf
                        <div class="form-row mb--20">
                            <div class="col-md-2 text-md-right">
                                <label for="contact_name">Your Name <sup>*</sup></label>
                            </div>
                            <div class="col-md-10">
                                <input id="name" name="name" placeholder="{!! __('Name') !!}" value="{!! old('name') !!}" class="form__input form__input--3 {!! $name = $errors->has('name') ? 'is-invalid':'' !!}" type="text">
                                    <span class="invalid-feedback" role="alert" style="display:block">
                                        <strong>{!! $errors->first('name') !!}</strong>
                                    </span>
                            </div>
                        </div>
                        <div class="form-row mb--20">
                            <div class="col-md-2 text-md-right">
                                <label for="contact_name">Your Email <sup>*</sup></label>
                            </div>
                            <div class="col-md-10">
                                <input id="email" name="email" placeholder="{!! __('Email') !!}" value="{!! old('email') !!}" class="form__input form__input--3 {!! $email = $errors->has('email') ? 'is-invalid':'' !!}" type="text">
                                    <span class="invalid-feedback" style="display:block" role="alert">
                                        <strong>{!! $errors->first('email') !!}</strong>
                                    </span>
                            </div>
                        </div>
                        <div class="form-row mb--20">
                            <div class="col-md-2 text-md-right">
                                <label for="contact_name">Your Phone <sup>*</sup></label>
                            </div>
                            <div class="col-md-10">
                                <input id="phone" name="phone" placeholder="{!! __('Phone') !!}" value="{!! old('phone') !!}" class="form__input form__input--3 {!! $phone = $errors->has('phone') ? 'is-invalid':'' !!}" type="text">
                                    <span class="invalid-feedback" style="display:block" role="alert">
                                        <strong>{!! $errors->first('phone') !!}</strong>
                                    </span>
                            </div>
                        </div>
                        <div class="form-row mb--20">
                            <div class="col-md-2 text-md-right">
                                <label for="contact_name">Enquiry <sup>*</sup></label>
                            </div>
                            <div class="col-md-10">                            
                                <textarea id="message" name="message" placeholder="{!! __('Message') !!}" value="{!! old('message') !!}" class="form__input form__input--3 form__input--textarea {!! $message = $errors->has('message') ? 'is-invalid':'' !!}" ></textarea>
                                    <span class="invalid-feedback" style="display:block" role="alert">
                                        <strong>{!! $errors->first('message') !!}</strong>
                                    </span>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-12 text-right">
                                <button type="submit" class="form__submit">Send Email</button>
                            </div>
                        </div>
                        <div class="form__output"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact Area End -->
</div>
<!-- Main Wrapper End -->

<!-- Footer Start -->
@endsection


<!-- Google Map -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCxvP66_Xk1ts77oL2Z7EpDxhDD_jMg-D0"></script>
<script>
// When the window has finished loading create our google map below
google.maps.event.addDomListener(window, 'load', init);

function init() {
    // Basic options for a simple Google Map
    // For more options see: https://developers.google.com/maps/documentation/javascript/reference#MapOptions
    var mapOptions = {
        // How zoomed in you want the map to start at (always required)
        zoom: 12,

        scrollwheel: false,

        // The latitude and longitude to center the map (always required)
        center: new google.maps.LatLng(40.740610, -73.935242), // New York

        // How you would like to style the map. 
        // This is where you would paste any style found on

        styles: [{
                "featureType": "water",
                "elementType": "geometry",
                "stylers": [{
                        "color": "#e9e9e9"
                    },
                    {
                        "lightness": 17
                    }
                ]
            },
            {
                "featureType": "landscape",
                "elementType": "geometry",
                "stylers": [{
                        "color": "#f5f5f5"
                    },
                    {
                        "lightness": 20
                    }
                ]
            },
            {
                "featureType": "road.highway",
                "elementType": "geometry.fill",
                "stylers": [{
                        "color": "#ffffff"
                    },
                    {
                        "lightness": 17
                    }
                ]
            },
            {
                "featureType": "road.highway",
                "elementType": "geometry.stroke",
                "stylers": [{
                        "color": "#ffffff"
                    },
                    {
                        "lightness": 29
                    },
                    {
                        "weight": 0.2
                    }
                ]
            },
            {
                "featureType": "road.arterial",
                "elementType": "geometry",
                "stylers": [{
                        "color": "#ffffff"
                    },
                    {
                        "lightness": 18
                    }
                ]
            },
            {
                "featureType": "road.local",
                "elementType": "geometry",
                "stylers": [{
                        "color": "#ffffff"
                    },
                    {
                        "lightness": 16
                    }
                ]
            },
            {
                "featureType": "poi",
                "elementType": "geometry",
                "stylers": [{
                        "color": "#f5f5f5"
                    },
                    {
                        "lightness": 21
                    }
                ]
            },
            {
                "featureType": "poi.park",
                "elementType": "geometry",
                "stylers": [{
                        "color": "#dedede"
                    },
                    {
                        "lightness": 21
                    }
                ]
            },
            {
                "elementType": "labels.text.stroke",
                "stylers": [{
                        "visibility": "on"
                    },
                    {
                        "color": "#ffffff"
                    },
                    {
                        "lightness": 16
                    }
                ]
            },
            {
                "elementType": "labels.text.fill",
                "stylers": [{
                        "saturation": 36
                    },
                    {
                        "color": "#333333"
                    },
                    {
                        "lightness": 40
                    }
                ]
            },
            {
                "elementType": "labels.icon",
                "stylers": [{
                    "visibility": "off"
                }]
            },
            {
                "featureType": "transit",
                "elementType": "geometry",
                "stylers": [{
                        "color": "#f2f2f2"
                    },
                    {
                        "lightness": 19
                    }
                ]
            },
            {
                "featureType": "administrative",
                "elementType": "geometry.fill",
                "stylers": [{
                        "color": "#fefefe"
                    },
                    {
                        "lightness": 20
                    }
                ]
            },
            {
                "featureType": "administrative",
                "elementType": "geometry.stroke",
                "stylers": [{
                        "color": "#fefefe"
                    },
                    {
                        "lightness": 17
                    },
                    {
                        "weight": 1.2
                    }
                ]
            }
        ]
    };

    // Get the HTML DOM element that will contain your map 
    // We are using a div with id="map" seen below in the <body>
    var mapElement = document.getElementById('google-map');

    // Create the Google Map using our element and options defined above
    var map = new google.maps.Map(mapElement, mapOptions);

    // Let's also add a marker while we're at it
    var marker = new google.maps.Marker({
        position: new google.maps.LatLng(40.740610, -73.935242),
        map: map,
        title: 'Lazio',
        icon: "assets/img/icons/marker.png",
        animation: google.maps.Animation.BOUNCE
    });
}
</script>

<!-- ************************* JS Files ************************* -->

<!-- jQuery JS -->
<script src="assets/js/vendor/jquery.min.js"></script>

<!-- Bootstrap and Popper Bundle JS -->
<script src="assets/js/bootstrap.bundle.min.js"></script>

<!-- All Plugins Js -->
<script src="assets/js/plugins.js"></script>
<!-- Ajax Mail Js -->
<script src="assets/js/ajax-mail.js"></script>

<!-- Main JS -->
<script src="assets/js/main.js"></script>

</body>

</html>