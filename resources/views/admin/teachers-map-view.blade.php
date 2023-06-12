@extends('admin.admin-layout')

@section('head')

<script src='https://api.mapbox.com/mapbox-gl-js/v2.10.0/mapbox-gl.js'></script>
<link href='https://api.mapbox.com/mapbox-gl-js/v2.10.0/mapbox-gl.css' rel='stylesheet' />

<script src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v5.0.0/mapbox-gl-geocoder.min.js"></script>
<link rel="stylesheet" href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v5.0.0/mapbox-gl-geocoder.css" type="text/css">

@endsection

@section('content')
<div class="techer-section container">
    <div class="row align-items-center mb-4">
        <div class="col-9">
            <span class="title col-6 d-flex align-items-center">Techers Map</span>
        </div>
        <div id="map" style="min-height:600px;min-height:400px;margin:auto"></div>
    </div>

</div>
@endsection

@section('script')
<script src="{{asset('js/admin/teachers-map.js')}}"></script>
@endsection