@extends('layouts.admin')

@section('content')
    <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-white bg-primary font-weight-bold">Detail Schedule: {{$schedule->name}}</div>
                <div class="card-body">
                    <table class="table">
                        <tbody>
                            <tr>
                                <td>Name </td>
                                <td>{{ $schedule->bus->bus_name }}</td>
                            </tr>
                            <tr>
                                <td>Departure Time</td>
                                <td>{{ $schedule->start_at }}</td>
                            </tr>
                            <tr>
                                <td>Start Destination</td>
                                <td>{{ $schedule->start_dest->name}}</td>
                            </tr>
                            <tr>
                                <td>Destination</td>
                                <td>{{$schedule->destination->name}}</td>
                            </tr>
                            <tr>
                                <td>Distance</td>
                                @if($schedule->distance == '0')
                                <td>Being calculated</td>
                                @else
                                <td>{{$schedule->distance}} km</td>
                                @endif
                            </tr>
                            <tr>
                                <td>Estimated Arrival Time</td>
                                @if($schedule->estimated_arrival_time == '0')
                                <td>Being calculated</td>
                                @else
                                <td>{{$schedule->estimated_arrival_time}}</td>
                                @endif
                            </tr>
                            <tr>
                                <td>Notes</td>
                                <td>{{$schedule->notes}}</td>
                            </tr>
                        </tbody>
                        <td><a href="{{ url('/admin/schedule')}}" class="btn btn-secondary">Go Back</a></td>
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
        var mapCenter = [{{ config('leaflet.map_center_latitude') }},
                    {{ config('leaflet.map_center_longitude') }},
                ];
        var map = L.map('map').setView(mapCenter,{{ config('leaflet.detail_zoom_level') }});
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap'
            }).addTo(map);
        var routing = L.Routing.control({
            waypoints: [
                L.latLng({{$schedule->start_dest->latitude}}, {{$schedule->start_dest->longitude}}),
                L.latLng({{$schedule->destination->latitude}}, {{$schedule->destination->longitude}})
            ]
            }).addTo(map);

        // Get Km and time
        routing.on('routesfound', function(e) {
            var routes = e.routes;
            var summary = routes[0].summary;
            var time = routes[0].summary;
            // alert time and distance in km and minutes
            console.log('Total distance is ' + summary.totalDistance / 1000 + ' km and total time is ' + Math.floor(time.totalTime / 3600) +"h"+ Math.floor(time.totalTime % 3600 / 60) + ' minutes');
            });
        // Show name and address of start destination 
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
                    return ('<div class="my-2"><strong>Destination Name</strong>: '+layer.feature.properties.name+'<div class="my-2"><strong>Address</strong>: '+layer.feature.properties.address+'</div>');
                }).addTo(map);
                // console.log(response.data);
            })
            .catch(function (error) {
                console.log(error);
            });
            // Show name and address of destination
             axios.get('{{ route('api.destination.index') }}')
            .then(function (response) {
                //console.log(response.data);
                L.geoJSON(response.data,{
                    pointToLayer: function(geoJsonPoint,latlng) {
                        return L.marker(latlng);
                    }
                })
                .bindPopup(function(layer) {
                    //return layer.feature.properties.map_popup_content;
                    return ('<div class="my-2"><strong>Destination Name</strong>: '+layer.feature.properties.name+'<div class="my-2"><strong>Address</strong>: '+layer.feature.properties.address+'</div>');
                }).addTo(map);
                // console.log(response.data);
            })
            .catch(function (error) {
                console.log(error);
            });
    </script>
@endsection