@extends('layouts.admin')

@section('content')
    <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-white bg-primary font-weight-bold">Detail Place: {{$start_destination->name}}</div>
                <div class="card-body">
                    <table class="table">
                        <tbody>
                            <tr>
                                <td>Name </td>
                                <td>{{ $start_destination->name }}</td>
                            </tr>
                            <tr>
                                <td>Address</td>
                                <td>{{ $start_destination->address }}</td>
                            </tr>
                        </tbody>
                        <td><a href="{{ url('/admin/start-dest')}}" class="btn btn-secondary">Go Back</a></td>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-6">
                <div class="card-header text-white bg-primary font-weight-bold">Detail Place</div>
                <div class="card-body" id="map"></div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script>
        var map = L.map('map').setView([{{ $start_destination->latitude }},{{ $start_destination->longitude }}],{{ config('leaflet.detail_zoom_level') }});
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap'
            }).addTo(map);
            L.marker([{{ $start_destination->latitude }},{{ $start_destination->longitude }}]).addTo(map)
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
                    return ('<div class="my-2"><strong>Place Name</strong>: '+layer.feature.properties.name+'<div class="my-2"><strong>Address</strong>: '+layer.feature.properties.address+'</div>');
                }).addTo(map);
                console.log(response.data);
            })
            .catch(function (error) {
                console.log(error);
            });
    </script>
@endsection