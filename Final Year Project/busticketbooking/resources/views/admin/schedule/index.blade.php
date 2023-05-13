@extends('layouts.admin')
@section('custom-css')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
@endsection
@section('content')
                <div class="d-sm-flex align-items-center mb-4">
                    <a class="h5 mb-0 mr-2 text-blue-800" href="{{url('admin/dashboard')}}">Dashboard</a> /
                    <p class="h5 mb-0 ml-2 text-gray-800">Schedule</p>
                </div>
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <div class="">
                    <!-- DataTales -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="mt-0 font-weight-bold text-primary"><i class="fa fa-eye"> View All Schedule</i>
                                @if(auth()->user()->hasRole('admin'))
                                    <a class=" btn btn-primary btn-sm float-right" href="{{url('admin/schedule/create')}}"><i class="fa fa-plus"> Add New Schedule</i></a>
                                @endif
                            </h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Bus Name</th>
                                            <th>Departure Time</th>
                                            <th>Start Point</th>
                                            <th>Destination</th>
                                            <th>Distance</th>
                                            <th>Price</th>
                                            <th>Estimated Arrival Time</th>
                                            <th>Notes</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
    
                                    <tfoot>
                                        <tr>
                                            <th>Bus Name</th>
                                            <th>Departure Time</th>
                                            <th>Start Point</th>
                                            <th>Destination</th>
                                            <th>Distance</th>
                                            <th>Price</th>
                                            <th>Estimated Arrival Time</th>
                                            <th>Notes</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
        <div id="map"></div>
@endsection

@section('scripts')
        <script>
        $(document).ready(function() {
            $('#dataTable').DataTable({
                processing: true,
                serverSide: true,
                select: true,
                ajax: '{{ url('/admin/get-all-schedule')}}',
                dom: 'lBfrtip',
                    buttons: [
                        {
                            extend: 'copy', 
                            text: '<i class="fas fa-copy"> Copy</i>',
                            className: 'btn-default',
                            titleAttr: 'Copy'
                        },
                        {
                            extend: 'pdf',
                            text: '<i class="fas fa-file-pdf"> Export PDF</i>',
                            className: 'btn-danger',
                            titleAttr: 'Pdf'
                        },
                        {
                            extend: 'csv',
                            text: '<i class="fas fa-file-csv"> Export CSV</i>',
                            className: 'btn-info',
                            titleAttr: 'Csv'
                        },
                        {
                            extend: 'excel',
                            text: '<i class="fas fa-file-excel"> Export Excel</i>',
                            className: 'btn-success',
                            titleAttr: 'Excel'
                        },
                        {
                            extend: 'print',
                            text: '<i class="fas fa-print"> Print</i>',
                            className: 'btn-light',
                            titleAttr: 'Print'
                        },
                    ],
                columns: [
                    {
                        data: 'bus_id',
                        name: 'bus_id',
                    },
                    {
                        data: 'start_at',
                        name: 'start_at'
                    },
                    {
                        data: 'start_destination_id',
                        name: 'start_destination_id',
                    },
                    {
                        data: 'destination_id',
                        name: 'destination_id',
                    },
                    {
                        data: 'distance',
                        name: 'distance',
                    },
                    {
                        data: 'price_schedules',
                        name: 'price_schedules',
                    },
                    {
                        data: 'estimated_arrival_time',
                        name: 'estimated_arrival_time',
                    },
                    {
                        data: 'notes',
                        name: 'notes',
                    },
                    {
                        data: 'action',
                        name: 'action',
                    },
                ]
            });
        });
    </script>
    {{-- Jquery --}}
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
    
    <script>
        var availableTags_startdestination = [
            
        ];
        $.ajax({
            method: "GET",
            url:"/admin/schedule/start-destination",
            success: function(response){
                // console.log(response)
                startAutoComplete_start_destination(response);
            }
        });
        function startAutoComplete_start_destination(availableTags_startdestination)
        {
            $( "#start_destination_id" ).autocomplete({
                source: availableTags_startdestination
            });
        }

        //Search Destination
        var availableTags_destination = [
            
        ];
        $.ajax({
            method: "GET",
            url:"/admin/schedule/destination",
            success: function(response){
                // console.log(response)
                startAutoComplete_destination(response);
            }
        });
        function startAutoComplete_destination(availableTags_destination)
        {
            $( "#destination_id" ).autocomplete({
                source: availableTags_destination
            });
        }
    </script>
@endsection