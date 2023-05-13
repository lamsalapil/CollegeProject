@extends('layouts.admin')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header text-white bg-primary font-weight-bold">Create Start Destination</div>
            <form method="POST" action="{{ route('admin.startdestination.store') }}" accept-charset="UTF-8">
                @csrf
                <div class="card-body">
                    <label>Name</label>
                    <input class="form-control form-control-lg" type="text" name="name" placeholder="Name of start point"> <br/>
                    
                    <label>Address</label>
                    <input class="form-control form-control-lg" type="text" name="address" placeholder="Address here.."> <br/>
                    
                    <label>Latitude</label>
                    <input class="form-control form-control-lg" id="latitude" type="text" name="latitude" placeholder="Lat" readonly> <br/>

                    <label>Longitude</label>
                    <input class="form-control form-control-lg" id="longitude" type="text" name="longitude" placeholder="Long" readonly> <br/>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-success">Submit</button>
                    <a href="{{route('admin.startdestination.index')}}">Go Back</a>
                </div>
            </form>
        </div>
    </div>
    <div class="col-md-6">
            <div class="text-center card-header text-white bg-primary font-weight-bold">Show on Open Street Map</div>
            <div class="card-body" id="map"></div>      
    </div>
</div>
@endsection 
@section('scripts')
<script>
    // get longlat default from config file
    var mapCenter = [{{ config('leaflet.map_center_latitude') }},
                    {{ config('leaflet.map_center_longitude') }},
                ];
    var map = L.map('map').setView(mapCenter, {{ config('leaflet.zoom_level') }});
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '© OpenStreetMap'
        }).addTo(map);
        
        var marker = L.marker(mapCenter).addTo(map);
        // Update marker when click m
        function updateMarker(lat, lng){
            marker
            .setLatLng([lat,lng])
            .bindPopup("Your location :" + marker.getLatLng().toString())
            .openPopup();
            return false;
        };
        map.on('click',function(e) {
            let latitude  = e.latlng.lat.toString().substring(0,15);
            let longitude = e.latlng.lng.toString().substring(0,15);
            $('#latitude').val(latitude);
            $('#longitude').val(longitude);
            updateMarker(latitude,longitude);
        });
        var updateMarkerByInputs = function () {
            return updateMarker( $('#latitude').val(), $('#longitude').val());
        }
        $('#latitude').on('input',updateMarkerByInputs);
        $('#longitude').on('input',updateMarkerByInputs);
</script>
@endsection
