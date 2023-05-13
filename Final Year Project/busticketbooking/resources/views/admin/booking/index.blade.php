@extends('layouts.admin')

@section('content')
    <div class="d-sm-flex align-items-center mb-4">
        <a class="h5 mb-0 mr-2 text-blue-800" href="{{url('admin/dashboard')}}">Dashboard</a> /
        <p class="h5 mb-0 ml-2 text-gray-800">Booking</p>
    </div>
    <div class="">
                    <!-- DataTales -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-eye"> View All Booking</i>
                            </h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>User</th>
                                            <th>Amount Seat</th>
                                            <th>Booking Date</th>
                                            <th>Booking Status</th>
                                            <th>Payment Method</th>
                                            <th>Total Price</th>
                                            <th>Start Destination</th>
                                            <th>Destination</th>
                                        </tr>
                                    </thead>
    
                                    <tfoot>
                                        <tr>
                                            <th>User</th>
                                            <th>Amount Seat</th>
                                            <th>Booking Date</th>
                                            <th>Booking Status</th>
                                            <th>Payment Method</th>
                                            <th>Total Price</th>
                                            <th>Start Destination</th>
                                            <th>Destination</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
@endsection

@section('scripts')

{{-- <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script> --}}

    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ url('/admin/get-all-booking')}}',
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
                        data: 'user_id',
                        
                    },
                    {
                        data: 'seat_number',
                        
                    },
                    {
                        data: 'booking_date',
                        
                    },
                    {
                        data: 'booking_status',
                        name: 'booking_status',
                    },
                    {
                        data: 'payment_method',
                        
                    },
                    {
                        data: 'total_price',
                        
                    },
                    {
                        data: 'start_id',
                        
                    },
                    {
                        data: 'destination_id',
                        
                    }
                ]
            });
        });
    </script>
@endsection