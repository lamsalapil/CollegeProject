@extends('layouts.admin')

@section('content')
                <div class="d-sm-flex align-items-center mb-4">
                    <a class="h5 mb-0 mr-2 text-blue-800" href="{{url('admin/dashboard')}}">Dashboard</a> /
                    <p class="h5 mb-0 ml-2 text-gray-800">Destination</p>
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
                            <h6 class="mt-0 font-weight-bold text-primary"><i class="fa fa-eye"> View All Info Destination</i>
                                <a class="btn btn-primary btn-sm float-right" href="{{route('admin.destination.create')}}"><i class="fa fa-plus"> Add New Destination</i></a>
                            </h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Address</th>
                                            <th>Latitude</th>
                                            <th>Longitude</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
    
                                    <tfoot>
                                        <tr>
                                            <th>Name</th>
                                            <th>Address</th>
                                            <th>Latitude</th>
                                            <th>Longitude</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
@endsection


@section('scripts')
    <script>
        $(function(){
            $('#dataTable').DataTable({
                processing:true,
                serverSide:true,
                ajax: '{{ url('/admin/get-all-dest')}}',
                columns: [
                    {
                        data: 'name',
                        name: 'name',
                    },
                    {
                        data: 'address',
                        name: 'address'
                    },
                    {
                        data: 'latitude',
                        name: 'latitude',
                    },
                    {
                        data: 'longitude',
                        name: 'longitude',
                    },
                    {
                        data: 'action',
                        name: 'action',
                    },
                ]
            })
        });
    </script>
@endsection