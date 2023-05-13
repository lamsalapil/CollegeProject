@extends('layouts.admin')

@section('content')
    <div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header text-white bg-primary font-weight-bold">Edit The Coupon</div>
            <form method="POST" action="{{ url('admin/coupon/update/'.$coupon->id) }}" accept-charset="UTF-8">
                @csrf
                <div class="card-body">
                    <label for="name_coupon" class="col-form-label">Coupon Name*</label>
                    <input type="text" class="form-control" name="name_coupon" id="name_coupon" value="{{$coupon->name_coupon}}" placeholder="Edit Coupon Name">
                    <br/>

                    <label for="coupon_code" class="col-form-label">Coupon Code*</label>
                    <input type="text" class="form-control" name="coupon_code" id="coupon_code" value="{{$coupon->coupon_code}}" readonly>
                    <br/>

                    <label>Coupon Limited Quantity*</label>
                    <input type="number" class="form-control" name="coupon_limited_quantity" value="{{$coupon->coupon_limited_quantity}}" id="coupon_limited_quantity" placeholder="Edit Coupon Quantity">
                    <br/>

                    <label>Price Coupon*</label>
                    <input type="number" class="form-control" name="price_coupon" value="{{$coupon->price_coupon}}" id="price_coupon" placeholder="Edit the price">
                    <br/>

                    <label>Start Day*</label>
                    <input type="datetime-local" class="form-control @error('valid_from') is-invalid @enderror" role="alert" value="{{$coupon->valid_from}}" name="valid_from" id="valid_from">
                    <br/>
                    
                    <label>Expiration Date*</label>       
                    <input type="datetime-local" class="form-control @error('valid_until') is-invalid @enderror" role="alert" value="{{$coupon->valid_until}}" name="valid_until" id="valid_until">
                    <br/>
                    <label>Status</label>
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" name="status" 
                        {{$coupon->status == '1' ? 'checked':''}} id="customSwitches">
                        <label class="custom-control-label" for="customSwitches">Switch on=Shown/ Switch Off=Not Shown</label>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-success">Submit</button>
                    <a href="{{route('admin.coupon.index')}}">Go Back</a>
                </div>
            </form>
        </div>
    </div>
    </div>
@endsection