@extends('layouts.admin')

@section('content')
                <div class="d-sm-flex align-items-center mb-4">
                    <a class="h5 mb-0 mr-2 text-blue-800" href="{{url('admin/dashboard')}}">Dashboard</a> /
                    <p class="h5 mb-0 ml-2 text-gray-800">Coupon</p>
                </div>
                <div class="">
                    <!-- DataTales -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="mt-0 font-weight-bold text-primary"><i class="fa fa-eye"> View All Coupon</i>
                                <button class=" btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-plus"> Add New Coupon</i></button>
                            </h6>
                        </div>
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Add New Coupon</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{ route('admin.coupon.create') }}" method="POST">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="name_coupon" class="col-form-label @error('name_coupon') is-invalid @enderror" role="alert">Coupon Name</label>
                                            <input type="text" class="form-control" name="name_coupon" id="name_coupon" placeholder="Enter Coupon Name">
                                            @error('name_coupon')
                                                <span class="invalid-feedback ">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="coupon_limited_quantity" class="col-form-label @error('coupon_limited_quantity') is-invalid @enderror" role="alert">Coupon Limited Quantity</label>
                                            <input type="number" class="form-control" name="coupon_limited_quantity" id="coupon_limited_quantity" placeholder="Enter Coupon Quantity">
                                            @error('coupon_limited_quantity')
                                                <span class="invalid-feedback ">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="price_coupon" class="col-form-label  @error('price_coupon') is-invalid @enderror">Price Coupon</label>
                                            <input type="number" class="form-control" name="price_coupon" id="price_coupon" placeholder="Enter the price">
                                            @error('price_coupon')
                                                <span class="invalid-feedback ">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="valid_from" class="col-form-label">Start Day</label>
                                            <input type="datetime-local" class="form-control @error('valid_from') is-invalid @enderror" role="alert" name="valid_from" id="valid_from">
                                            @error('valid_from')
                                                <span class="invalid-feedback ">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="valid_until" class="col-form-label">Expiration Date</label>
                                            <input type="datetime-local" class="form-control @error('valid_until') is-invalid @enderror" role="alert" name="valid_until" id="valid_until">
                                            @error('valid_until')
                                                <span class="invalid-feedback ">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <legend for="status" class="col-form-label">Status</legend>
                                            <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input" name="status" id="customSwitches">
                                                    <label class="custom-control-label" for="customSwitches">Switch on=Shown/ Switch Off=Not Shown</label>
                                            </div>
                                            @error('status')
                                                <span class="invalid-feedback ">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-primary">Create</button>
                                    </div>
                                </form>
                                </div>
                            </div>
                            </div>
                    <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Code</th>
                                            <th>Quantity</th>
                                            <th>Price</th>
                                            <th>Start Day</th>
                                            <th>Expiration Date</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
    
                                    <tfoot>
                                        <tr>
                                            <th>Name</th>
                                            <th>Code</th>
                                            <th>Quantity</th>
                                            <th>Price</th>
                                            <th>Start Day</th>
                                            <th>Expiration Date</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            var table = $('#dataTable').DataTable({
                processing: true,
                serverSide: true,
                select: true,
                ajax: '{{url('/admin/get-all-coupon')}}',
                // export csv, excel, pdf...
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
                        data: 'name_coupon',
                        name: 'name_coupon'
                    },
                    {
                        data: 'coupon_code',
                        name: 'coupon_code',
                    },
                    {
                        data: 'coupon_limited_quantity',
                        name: 'coupon_limited_quantity'
                    },
                    {
                        data: 'price_coupon',
                        name: 'price_coupon',
                    },
                    {
                        data: 'valid_from',
                        name: 'valid_from',
                    },
                    {
                        data: 'valid_until',
                        name: 'valid_until',
                    },
                    {
                        data: 'status',
                        name: 'status',
                    },
                    {
                        data: 'action',
                        name: 'action',
                    }
                ],
            });
        });
    </script>
    <script>
    @if ($errors->has('name_coupon')||$errors->has('valid_from')||$errors->has('coupon_limited_quantity')||$errors->has('price_coupon'))
        var delayInMilliseconds = 1000;
        setTimeout(function() {
        $("#exampleModal").modal('show');
        }, delayInMilliseconds);
    @endif
    </script>   
@endsection