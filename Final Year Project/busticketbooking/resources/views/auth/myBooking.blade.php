@extends('layouts.frontend')

@section('content')
    <div class="hero-wrap js-fullheight"
	style="background-image: url('https://images.unsplash.com/photo-1633265486064-086b219458ec?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1470&q=80');">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text js-fullheight align-items-center justify-content-center"
                data-scrollax-parent="true">
                <div class="col-md-9 text-center ftco-animate" data-scrollax=" properties: { translateY: '70%' }">
                    <p class="breadcrumbs" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }"><span
                            class="mr-2"><a href="{{url('/')}}">Home</a></span> <span>View My Booking</span></p>
                    <h1 class="mb-3 bread" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }">My Booking</h1>
                </div>
            </div>
        </div>
    </div>
<div class="container py-5">
    <div class="row text-center text-white">
        <div class="col-lg-8 mx-auto">
            <h1 class="display-4">My Billing</h1>
        </div>
    </div>
</div><!-- End -->
@foreach ($booking as $book)
<div class="container">
    <div class=" text-center">
        <div class="col mb-3">
            <div class="bg-white rounded shadow-sm py-5 px-4 border border-secondary"><img src="{{asset('/admin/upload/img/'.$book->user->avatar)}}" alt="" width="100" height="100" class="img-fluid rounded-circle mb-3 img-thumbnail shadow-sm">
                <h5 class="mb-0">{{$book->user->name}}</h5>
                <span class="small text-uppercase text-muted">{{$book->user->email}}</span>
                <p class="card-text">Amount Seat: {{$book->seat_number}}</p>
                <p class="card-text">Booking Date: {{$book->booking_date}}</p>
                @if($book->booking_status == 0)
                    <p class="card-text">Booking Status: <span class="badge badge-danger">Not Paid</span></p>
                @elseif($book->booking_status == 1)
                    <p class="card-text">Booking Status: <span class="badge badge-success">Paid</span></p>
                @endif
                <p class="card-text">Payment Method: {{$book->payment_method}}</p>
                <p class="card-text">Total Price: {{$book->total_price}}USD</p>
                @foreach ($schedule as $sche)    
                    <p class="card-text">Start Destination: {{$sche->start_dest->name}}</p>
                    <p class="card-text">Destination: {{$sche->destination->name}}</p>
                    <p class="card-text">Bus Name: {{$sche->bus->bus_name}}</p>
                @endforeach
                {{-- Cancel Booking --}}
                {{-- <form action="{{url('my-booking/'.$book->id)}}" method="POST">
                    @csrf
                    @method('Delete')
                    <button type="submit" onclick="return confirm('Are you sure to Cancel this booking?')" class="btn btn-danger text-white">Cancel Booking</button>
                </form> --}}
            </div>
        </div><!-- End -->

    </div>
</div>
@endforeach

@endsection