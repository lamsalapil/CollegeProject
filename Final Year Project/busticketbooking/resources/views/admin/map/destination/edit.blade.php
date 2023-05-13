@extends('layouts.admin')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-white bg-primary font-weight-bold">Edit Destination</div>
                <form method="POST" action="{{ route('admin.destination.update', ['id' => $destination->id]) }}" accept-charset="UTF-8">
                    @csrf
                    <div class="card-body">
                        <label>Name</label>
                        <input class="form-control form-control-lg" type="text" name="name" placeholder="Name of destination" value="{{$destination->name}}"> <br/>
                        
                        <label>Address</label>
                        <input class="form-control form-control-lg" type="text" name="address" placeholder="Edit Address here.." value="{{$destination->address}}"> <br/>
                        
                        <label>Latitude</label>
                        <input class="form-control form-control-lg" id="latitude" type="text" name="latitude" placeholder="Lat" readonly value="{{$destination->latitude}}"> <br/>

                        <label>Longitude</label>
                        <input class="form-control form-control-lg" id="longitude" type="text" name="longitude" placeholder="Long" readonly value="{{$destination->longitude}}"> <br/>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-success">Update</button>
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
        // Get lat long cureent
        var mapCenter = [
            {{ $destination->latitude }},
            {{ $destination->longitude }},
        ];
        var map = L.map('map').setView(mapCenter,{{ config('leaflet.zoom_level') }});
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap'
        }).addTo(map);
        var marker = L.marker(mapCenter).addTo(map);
        function updateMarker(lat,lng){
            marker
            .setLatLng([lat,lng])
            .bindPopup("Your Current location :" + marker.getLatLng().toString())
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
        // Get input lat and long by id
        $('#latitude').on('input',updateMarkerByInputs);
        $('#longitude').on('input',updateMarkerByInputs);
    </script>
@endsection