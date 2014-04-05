@extends('layouts/main')

@section('content')
	<div class="page-header">
        <h1>Create A New Project <small>and get working</small></h1>
    </div>
    {{ Form::open(array('url' => action('ProjectController@store'), 'method' => 'post' )) }}
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" name="title" value="{{ Input::old('title') }}"/>
            @if ($error = $errors->first('title'))
                <div class="error"> {{ $error }} </div>
            @endif
        </div>
        <div class="form-group">
            <label for="tagline">Tagline</label>
            <input type="text" class="form-control" name="tagline" value="{{ Input::old('tagline') }}"/>
            @if ($error = $errors->first('tagline'))
                <div class="error"> {{ $error }} </div>
            @endif
        </div>
        <div class="form-group">
            <label for="about">About</label>
            <textarea class="form-control" name="about">{{ Input::old('about') }}</textarea>
            @if ($error = $errors->first('about'))
                <div class="error"> {{ $error }} </div>
            @endif
        </div>
        <div class="form-group">
            <label for="tags">Tags (comma-separated)</label>
            <input type="text" class="form-control" name="tags">{{ Input::old('tags') }}</textarea>
            @if ($error = $errors->first('tags'))
                <div class="error"> {{ $error }} </div>
            @endif
        </div>
        <div class="form-group">
            <label for="tags">Location</label>
            <div id="map"></div>
            <div id="map-canvas"></div>
            <input id="pac-input" class="controls" type="text" placeholder="Search Box" value="{{ $geoip->city }}, {{ $geoip->region_code }} {{ $geoip->postal_code }}, {{ $geoip->country }} " onkeydown="if(event.keyCode == 13) { event.preventDefault(); return false; }" onclick="this.setSelectionRange(0, this.value.length);">
            <input id="lat" type="hidden" name="latitude" value="{{ $geoip->latitude }}" />
            <input id="lon" type="hidden" name="longitude" value="{{ $geoip->longitude }}" />
        </div>
        <input type="submit" value="Create" class="btn btn-primary" />
        <a href="{{ action('ProjectController@index') }}" class="btn btn-link">Cancel</a>
    {{ Form::close() }}
@stop

@section('styles')
@parent
<style>
      html, body, #map-canvas {
        height: 100%;
        min-height: 300px;
        margin: 0px;
        padding: 0px
      }
      .controls {
        margin-top: 16px;
        border: 1px solid transparent;
        border-radius: 2px 0 0 2px;
        box-sizing: border-box;
        -moz-box-sizing: border-box;
        height: 32px;
        outline: none;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
      }

      #pac-input {
        background-color: #fff;
        padding: 0 11px 0 13px;
        width: 400px;
        font-family: Roboto;
        font-size: 15px;
        font-weight: 300;
        text-overflow: ellipsis;
      }

      #pac-input:focus {
        border-color: #4d90fe;
        margin-left: -1px;
        padding-left: 14px;  /* Regular padding-left + 1. */
        width: 401px;
      }

      .pac-container {
        font-family: Roboto;
      }

      #type-selector {
        color: #fff;
        background-color: #4d90fe;
        padding: 5px 11px 0px 11px;
      }

      #type-selector label {
        font-family: Roboto;
        font-size: 13px;
        font-weight: 300;
      }
}

    </style>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=places&key=AIzaSyBXVO4BKHWYxNneUCybbSDIAwojuUCboNk"></script>
<script>
function initialize() {

  var markers = [];
  var map = new google.maps.Map(document.getElementById('map-canvas'), {
    center: new google.maps.LatLng({{ $geoip->latitude }}, {{ $geoip->longitude }}),
    zoom: 10,
    maxZoom: 17,
    mapTypeId: google.maps.MapTypeId.ROADMAP
  });

  // Create the search box and link it to the UI element.
  var input = /** @type {HTMLInputElement} */(
      document.getElementById('pac-input'));
  map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

  var searchBox = new google.maps.places.SearchBox(
    /** @type {HTMLInputElement} */(input));

  var lat = document.getElementById('lat');
  var lon = document.getElementById('lon');
  // [START region_getplaces]
  // Listen for the event fired when the user selects an item from the
  // pick list. Retrieve the matching places for that item.
  google.maps.event.addListener(searchBox, 'places_changed', function() {
    var places = searchBox.getPlaces();

    for (var i = 0, marker; marker = markers[i]; i++) {
      marker.setMap(null);
    }

    // For each place, get the icon, place name, and location.
    markers = [];
    var bounds = new google.maps.LatLngBounds();
    for (var i = 0, place; place = places[i]; i++) {
      var image = {
        url: place.icon,
        size: new google.maps.Size(71, 71),
        origin: new google.maps.Point(0, 0),
        anchor: new google.maps.Point(17, 34),
        scaledSize: new google.maps.Size(25, 25)
      };

      // Create a marker for each place.
      var marker = new google.maps.Marker({
        map: map,
        icon: image,
        title: place.name,
        position: place.geometry.location
      });

      markers.push(marker);

      bounds.extend(place.geometry.location);
    }

    map.fitBounds(bounds);

    // store the new latitude and longitude values in the form
    var center = map.getCenter();
    lat.value = center.k;
    lon.value = center.A;
  });
  // [END region_getplaces]

  // Bias the SearchBox results towards places that are within the bounds of the
  // current map's viewport.
  google.maps.event.addListener(map, 'bounds_changed', function() {
    var bounds = map.getBounds();
    searchBox.setBounds(bounds);
  });
}
google.maps.event.addDomListener(window, 'load', initialize);
</script>
@stop
