@extends('layouts.admin')

@section('content')
    <div id="map">
        <div class="card">
            <div class="card-body"></div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
var map = L.map('map').setView([{{ config('nepal.map_center_latitude') }},
    {{ config('nepalsetup.map_center_longitude') }}],
    {{ config('nepalsetup.zoom_level') }});

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    axios.get('{{ route('api.places.index') }}')
    .then(function (response) {
        //console.log(response.data);
        L.geoJSON(response.data,{
            pointToLayer: function(geoJsonPoint,latlng) {
                return L.marker(latlng);
            }
        })
        .bindPopup(function(layer) {
            //return layer.feature.properties.map_popup_content;
            return ('<div class="my-2"><strong>Place Name</strong> :<br>'+layer.feature.properties.name+'</div> <div class="my-2"><strong>Description</strong>:<br>'+layer.feature.properties.description+'</div><div class="my-2"><strong>Address</strong>:<br>'+layer.feature.properties.address+'</div>');
        }).addTo(map);
        console.log(response.data);
    })
    .catch(function (error) {
        console.log(error);
    });

</script>
@endsection

