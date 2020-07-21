@extends('layouts.app')
@section('content')
<style>
    #map-canvas {
        height: 100%;
        width: 100%;
    }

    .mapClass {
        height: 500px;
        margin: 0;
        padding: 0;
        width: 100%;
    }
    .gm-style-iw{
        width : 200px;
    }
</style>
<div class="row" id="js_main_row">
    <form action="{{ route('deliveryboy.add') }}" method="post" class="needs-validation"  enctype="multipart/form-data">
<div class="container-fluid">    
    <div class="row header">
        <div class="col-lg-10">
            <h1>Add Geofence</h1>
            <ul class="breadcrumb">
                <li>{{__('Home')}}</li>
                <li><a href="{{route('deliveryboy.manage')}}">{{__('Add Geofence')}}</a></li>
            </ul>
        </div>
        <div class="col-sm-2 text-right">
            <button  type="submit"  id="js_submit_ajax" class="btn btn-primary" style="margin:3px" data-toggle="tooltip" title="Save"><i class="fa fa-save"></i></button>
            <a href="{{route('deliveryboy.manage')}}" data-toggle="tooltip" title="" class="btn btn-default" data-original-title="Cancel"><i class="fa fa-reply"></i></a>
        </div>
    </div>
    <hr>
</div>
<br>

<div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-list"></i> {{__('Add Geofence')}}</h3>
    </div>
    <div class="panel-body">
        {{ csrf_field() }}
        <div class="card-body">
            <div class="form-group row">
                <div class="col-md-6">
                    <label>Name</label>
                    <input
                    type="text"
                    class="form-control"
                    id="name"
                    placeholder="Enter name"
                    name="name"
                    value=""
                    autocomplete="off"
                    required>
            </div>
            <div class="col-md-6">
                <label>Region</label>
                <select name="region" id="region" class="form-control js-example-basic-single"
                onchange="GetLatlong(),getCities(0)">
            <option value="">Select Region</option>
            @foreach($regions as $region)
                <option value="{{ $region->id }}"
                        data-name="{{ $region->state_en_name }}"
              
                @if(isset($data) && ($data->region == $region->id)) selected @endif
                >
                    {{ $region->state_en_name }}
                </option>
            @endforeach
        </select>
            </div>


            </div>
            <div class="form-group row">
                <div class="col-md-6">
                    <label>City</label>
                    <select name="city" id="city" class="form-control js-example-basic-single"
                    onchange="GetLatlong(),getDistricts(0)">
                <option value="">Select City</option>
            </select>


                </div>
                <div class="col-md-6">
                    <label>District</label>
                    <select name="district" id="district"
                    class="form-control js-example-basic-single" onchange="GetLatlong()">
                <option value="">Select District</option>
            </select>
                </div>


            </div>
            <div class="form-group row">
                <div class="col-md-12">
                    <label>Description</label>
                    <textarea name="description" class="form-control" rows="3" cols="20"></textarea>
								

                </div>
            </div>

			<div class="form-group row mapClass">
				<small class="text-danger">
																(Note* You can draw at a time only one area on map)
														</small>
				<div id="map-canvas"></div>
				<div id="points_html" class="mt-4"></div>
				<input type="hidden" id="points" name="points">

				
				<input type="button" id="resetPolygon" value="Reset" style="display: none;" />
			</div>
</div>
    </div>
</div>
    </form>

</div>
@endsection
@section('script')

<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyA076wP-I4xkrj0cD62O9KSJNXxGmLh1gc&libraries=drawing&sensor=false"></script>
<script type="text/javascript">

var data = "";
    var drawingManager;
	if(window.location.href.indexOf("geofence-edit") > -1)
	{
		//Select city and district value while edit
		  var city_id ="{{ isset($data) ? $data->city : '' }}";
		  getCities(city_id);
      	drawingManager.setMap(null);
	}
	//Set city and district old value while validation
	var old_city = "{{ (old('city') != NULL) ? old('city'): ''  }}";
	if(old_city !== '') { getCities(old_city); }

	function getCities(city_id)
	{
		$('#city').html('');
		var region = $('#region').find(':selected').val();

		$.ajax({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			url: '{{ route("geofence.city") }}',
			data: 'region=' + region+'&city_id='+city_id,
			type: 'POST',
			success: function (res) {
              //  alert(res);
				$('#city').html(res);
				$("#city").val(city_id).trigger('change');

				//set old value
				var old_district = "{{ (old('district') != NULL) ? old('district'): ''  }}";
				if(old_district !== '') { getDistricts(old_district); }

				var district_id ="{{ isset($data) ? $data->district : '' }}";
				getDistricts(district_id);
			}
		});
	}

  	function getDistricts(district_id)
	{
	   	$('#district').html('');
        var city = $('#city').find(':selected').val();
        $.ajax({
        	headers: {
            	'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          	},
			url: '{{ route("geofence.district") }}',
			data: 'city='+city+'&district_id='+district_id,
			type: 'POST',
			success: function (res) {
            	$('#district').html(res);
            	$("#district").val(district_id).trigger('change');
          	}
        });
    }

	var zoom;
    function GetLatlong()
	{
        var geocoder = new google.maps.Geocoder();
        var district = $('#district').find(':selected').data('name');
        var region = $('#region').find(':selected').data('name');
        var city = $('#city').find(':selected').data('name');

        if (region) { var address = region + ' , saudi arabia';  zoom =  8; }
        if (city) { var address = city + ' , '+ region+ ' , saudi arabia';  zoom =  10; }
        if (district)  { var address = district + ' , '+ city +' , saudi arabia';  zoom = 12; }

        //Get latitude and longitude of Region / City / District
        geocoder.geocode({'address': address}, function (results, status) {
        	if (status == google.maps.GeocoderStatus.OK) {
				var latitude = results[0].geometry.location.lat();
				var longitude = results[0].geometry.location.lng();
				data = {'lat': latitude, 'long': longitude,'zoom' : zoom};
              	initialize();
          	}
        });
    }

        /* START */
        var map;
        var infoWindow;

	function initialize()
	{
        var selectedShape;
		$("#points").val('');
			if (data.lat || data.long) {
				var latitude = data.lat;
				var longitude = data.long;
			} else {
				var latitude = 23.8859; //Saudi arabia lat long
				var longitude = 45.0792;
			}
			//Assign Region , City or District Lat long
	  		if(data.zoom)
	  			zoom = data.zoom;
	  		else
	  		  	zoom = 7;

			var mapOptions = {
				zoom: zoom,
				center: {lat: latitude, lng: longitude}
			};
			map = new google.maps.Map(document.getElementById('map-canvas'),mapOptions);
			infoWindow = new google.maps.InfoWindow();

			var pausecontent = new Array();

			<?php
				foreach($coordinates as $key => $val){ ?>
					pausecontent.push('<?php echo $val; ?>');
			<?php } ?>

			for (const [key, value] of Object.entries(pausecontent))
			{
				var geo_data = JSON.parse(value);
				var polygon = geo_data.coordinates;
				var remove_polygon = polygon.replace("POLYGON((", '');
				remove_polygon = remove_polygon.replace("))", '');
				var points = remove_polygon.split(",");
				var latlong = new Array();

				points.forEach(function (point) {
					var geo_point = point.replace(' ', ',');
					var abc = geo_point.split(',');

					latlong.push({ lat : parseFloat(abc[0]) , lng : parseFloat(abc[1]) });
				});

				 var bermudaTriangle = new google.maps.Polygon({
						paths : latlong,
						strokeColor: '#FF0000',
						strokeOpacity: 0.8,
						strokeWeight: 1,
						fillColor: '#FF0000',
						fillOpacity: 0.35,
						name:  geo_data.name, // dynamic, not an official API property..
						map: map
				 });
				google.maps.event.addListener(bermudaTriangle, 'click', showArrays);

			}

		//Draw polygon
		drawingManager = new google.maps.drawing.DrawingManager({
			//drawingMode: google.maps.drawing.OverlayType.MARKER,
			drawingControl: true,
			drawingControlOptions: {
			  position: google.maps.ControlPosition.TOP_CENTER,
			  drawingModes: ['polygon']
			}
		});
		drawingManager.setMap(map);

		// Get polygon points
		google.maps.event.addListener(drawingManager, 'polygoncomplete', function (polygon) {
		  	$("#points").val('');
		  	for (var i = 0; i < polygon.getPath().getLength(); i++) {
			  document.getElementById('points').value += polygon.getPath().getAt(i).toUrlValue(6) + "|";
			}
          drawingManager.setMap(null);
          //$('#resetPolygon').show();
		});

		if(window.location.href.indexOf("geofence-edit") > -1)
		{
			drawingManager.setMap(null);
		}
	}
    $('#resetPolygon').click(function (){
      drawingManager.setMap(null);
      //marker = null; // To remove drawing tool
    });

	function showArrays(event) {
	  var vertices = this.getPath();
	  var contentString = '<b>' + this.name + '</b><br>';

	  infoWindow.setContent(contentString);
	  infoWindow.setPosition(event.latLng);
	  infoWindow.open(map);
	}
    initialize();

</script>
@endsection