@extends('layouts.frontend')
@section('custom-css')
    
@endsection
@section('content')
    <div class="hero-wrap js-fullheight image_container"
	    style="background-image: url('https://images.pexels.com/photos/21014/pexels-photo.jpg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2'); ">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text js-fullheight align-items-center justify-content-center"
                data-scrollax-parent="true">
                <div class="col-md-9 text-center ftco-animate" data-scrollax=" properties: { translateY: '70%' }">
                    <p class="breadcrumbs" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }"><span
                            class="mr-2"><a href="{{url('/')}}">Home</a></span> <span>Show Map</span></p>
                    <h1 class="mb-3 bread" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }">Location</h1>
                </div>
            </div>
        </div>
    </div>
    <section class="ftco-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 order-md-last ftco-animate">
                    <a class="btn rounded text-white" style="background:#2F3C7E" href="{{url('/schedules')}}"><i class="fa-solid fa-square-caret-left"></i> Back</a>
                    <div class="card mt-2">
                        <div class="card-body mt-2">
                            <form method="POST" action="{{url('/booking')}}">
                            @csrf
                                <h5 class="card-title font-weight-bold text-center">Detail Booking</h5>
                                <div class="form-group">
                                    <input type="hidden" name="schedule_id" class="schedule_id" value="{{$schedule->id}}"/>
                                </div>
                                <div class="form-group">
                                    <label>Bus Name</label>
                                    <input type="text" class="form-control" placeholder="bus name" value="{{$schedule->bus->bus_name}}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Quantiy of seats</label>
                                    <input type="number" min="0" name="choose_seats" 
                                                value="{{request()->input('choose_seats')}}"
                                                placeholder="Quantity of seats" 
                                                class="form-control text-secondary rounded border border-success font-weight-bold seat_number" readonly>
                                </div>
                                
                                <div class="form-group">
                                    <label>Start Destination</label>
                                    <input type="text" id="start_dest" name="start_dest" class="form-control" 
                                        value="{{$schedule->start_dest->name}}"
                                        autocomplete="off" placeholder="Date" readonly>
                                </div>
                                <div class="form-group">
                                    <label>Destination</label>
                                    <input type="text" id="dest" name="dest" class="form-control" 
                                        value="{{$schedule->destination->name}}"
                                        autocomplete="off" placeholder="Date" readonly>
                                </div>
                                <div class="form-group">
                                    <label>Estimated Arrival Time</label>
                                    <input type="text" value="{{$schedule->estimated_arrival_time}}" class="form-control" readonly>
                                </div>
                                <div class="form-group">
                                    <label>Start Date</label>
                                    <input type="datetime-local" id="start_day" name="start_day" class="form-control" 
                                        value="{{$schedule->start_at}}"
                                        autocomplete="off" placeholder="Date" readonly>
                                </div>
                                @php $total = 0; @endphp
                                @php $total = request()->input('choose_seats') * $schedule->price_schedules; @endphp
                                <input type="hidden" name="payment_mode" value="COD">
                                <button class="btn btn-secondary w-100 mt-3" type="submit"><i class="fas fa-money-bill"></i> Place Order | COD</button>
                                
                                <!-- <button class="btn btn-success w-100 mt-3 mb-2 paypal.Buttons" type="submit">
                                    <svg role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" height="24" width="24"><path d="m22.436 0-11.91 7.773-1.174 4.276 6.625-4.297L11.65 24h4.391l6.395-24zM14.26 10.098 3.389 17.166 1.564 24h9.008l3.688-13.902z" fill="white"></path></svg> 
                                    Pay With paypal
                                </button> -->
                                <button id="paypal-button-container" class="btn btn-secondary w-100 mt-3 paypal-button-container" type="submit">Paypal</button>
                                <!-- <div id="paypal-button-container" class="paypal-button-container"></div> -->
                                
                            </form>
                            
                        </div>
                        
                    </div>
                </div>
                <div class="col-lg-9">
                    <div>
                        <div class="card-header text-white bg-primary font-weight-bold rounded-top">Detail Place (Pick up & Drop off)</div>
                        <div id="map">
                        </div>
                        <hr/>
                        <div class="form-row">
                            <div class="form-group col-md-9">
                                <form action="{{url('/check-coupon-code')}}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                            Coupon Code
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" value="{{old('coupon_code')}}" placeholder="Enter Coupon Code" name="coupon_code">
                                                <div class="input-group-append">
                                                    <button class="btn btn-secondary apply_coupon_code_btn" type="submit">Apply</button>
                                                </div>
                                            </div>
                                    </div>
                                </form>
                            </div>
                            <div class="form-group col-md-3 d-flex align-items-center mt-2">
                                {{-- Check if have coupon value then display remove coupon button--}}
                                @if(Session::get('coupon'))
                                    <a class="btn text-white" style="background-color:red;" href="{{url('/remove-coupon')}}"><i class="fas fa-trash"></i> Remove Coupon</a>
                                @endif
                            </div>
                        </div>
                        <ul class="list-group">
                            <li class="list-group-item font-weight-bold">Total Price: <span name="total" value="{{request()->input('choose_seats') * $schedule->price_schedules}}">{{number_format($total,0,',','.')}} USD</span></li>
                                @if(Session::get('coupon'))
                                    <li class="list-group-item font-weight-bold">
                                        @foreach (Session::get('coupon') as $key => $count)
                                            Coupon: {{number_format($count['price_coupon'],0,',','.')}} USD
                                            <p class="coupon_id">
                                                @php
                                                $total_coupon = $total-$count['price_coupon'];
                                                @endphp
                                            </p>
                                            <p><li class="list-group-item font-weight-bold">Total amount after applying coupon: {{number_format($total_coupon,0,','.'.')}} USD</li></p>
                                        @endforeach
                                    </li>
                                @endif
                        </ul>
                    </div>

                    {{-- <div class="card" style="width: 18rem;">
                    <form action="{{url('/checkout')}}" method="POST">
                        @csrf
                        <div class="card-body">
                            <h5 class="card-title"></h5>
                            <input type="hidden" name="booking_id">
                            <input type="hidden" name="payment_mode" value="COD">
                            <li class="list-group-item font-weight-bold">Total Price: <span name="total" value="{{request()->input('choose_seats') * $schedule->price_schedules}}">{{number_format($total,0,',','.')}} USD</span></li>

                            <button class="btn btn-secondary w-100 mt-3" type="submit">Place Order | COD</button>
                          
                            <!-- <button class="btn btn-success w-100 mt-3 razorpay-btn" type="submit">Pay With Razorpay</button> -->
                            <br/><br/>
                            <div id="paypal-button-container" class="paypal-button-container">  <button class="btn btn-secondary w-100 mt-3" type="submit">Paypal</button></div>
                        </div>
                    </form>
                    </div> --}}

                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
{{-- Razorpay --}}
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>

<script src="https://www.paypal.com/sdk/js?client-id=AcImd653WkVeUKRGVYq1GnlC9eiImFU5JaoHWwFjdEwt-KFFjO-iL5B0DUAWheL15GrQfnYDWCxgp-4-&currency=USD"></script>

<script>
        var mapCenter = [{{ config('Nepal.map_center_latitude') }},
                    {{ config('Nepal.map_center_longitude') }},
                ];
        var map = L.map('map').setView(mapCenter,{{ config('Nepal.detail_zoom_level') }});
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
                    return ('<div class="my-2"><strong>Start Destination Name</strong>: '+layer.feature.properties.name+'<div class="my-2"><strong>Address</strong>: '+layer.feature.properties.address+'</div>');
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

        //Checkout by paypal        
        paypal.Buttons({
        // Sets up the transaction when a payment button is clicked
        createOrder: (data, actions) => {
          return actions.order.create({
            purchase_units: [{
              amount: {
                value: '{{$total}}' // Can also reference a variable or function
              }
            }]
          });
        },
        // Finalize the transaction after payer approval
        onApprove: (data, actions) => {
          return actions.order.capture().then(function(orderData) {
            // Successful capture! For dev/demo purposes:
            console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
            const transaction = orderData.purchase_units[0].payments.captures[0];
            // alert(`Transaction ${transaction.status}: ${transaction.id}\n\nSee console for all available details`);
            var seat_number = $('.seat_number').val();
            var schedule_id = $('.schedule_id').val();
            var coupon_id = $('.coupon_id').val(); 
            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });
            $.ajax({
                method: "POST",
                url: "/booking",
                    // Bên trái là giá trị input từ controller
                    data: {
                    'choose_seats': seat_number,
                    'payment_mode': "Paid by Paypal",
                    'payment_id': transaction.id,
                    'schedule_id': schedule_id,
                    'coupon_id': coupon_id,
                    },
                    success: function(responseb){
                                // Sau khi thông báo thành công thì sẽ đợi người dùng xác nhận 
                                swal(responseb.status).then((value) => { 
                                        window.location.href ="/schedules";
                                    });
                            }
                        });
            
            // When ready to go live, remove the alert and show a success message within this page. For example:
            // const element = document.getElementById('paypal-button-container');
            // element.innerHTML = '<h3>Thank you for your payment!</h3>';
            // Or go to another URL:  actions.redirect('thank_you.html');
          });
        }
      }).render('#paypal-button-container');


    //razorpay
    $(document).ready(function(){
        $('.razorpay-btn').click(function (e){
            e.preventDefault();

            var seat_number = $('.seat_number').val();
            var schedule_id = $('.schedule_id').val();
            var coupon_id = $('.coupon_id').val(); 

            // Display text error
            // seat number
            
                var data = {
                        'choose_seats': seat_number,
                        'schedule_id': schedule_id,
                        'coupon_id': coupon_id,
                }
                $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                });
                $.ajax({
                    method: "POST",
                    url: "/proceed-to-pay",
                    data: data,
                    success: function(response) {
                        //alert(response.total_price);
                        var options = {
                            "key": "rzp_test_5Ov6i6zcOtn3tK", // Enter the Key ID generated from the Dashboard
                            "amount": response.total_price*100, // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
                            "currency": "USD",
                            "name": 'Scott',
                            "description": "Thank you for choosing us",
                            "image": "data:image/png;base64,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",
                            // "order_id": "order_9A33XWu170gUtm", //This is a sample Order ID. Pass the `id` obtained in the response of Step 1
                            "handler": function (responsea){
                                // alert(responsea.razorpay_payment_id);
                                $.ajax({
                                    method: "POST",
                                    url: "/booking",
                                    data: {
                                        // Bên trái là giá trị input từ controller
                                        'choose_seats': response.choose_seats,
                                        'schedule_id': response.schedule_id,
                                        'coupon_id': response.coupon_id,
                                        'payment_mode': "Paid by Razorpay",
                                        'payment_id': responsea.razorpay_payment_id,
                                    },
                                    success: function(responseb){
                                        // Sau khi thông báo thành công thì sẽ đợi người dùng xác nhận 
                                        swal(responseb.status).then((value) => { 
                                            window.location.href ="/schedules";
                                        });
                                    }
                                });
                            },
                            "prefill": {
                                "name": 'scott',
                                "email": '',
                                "contact": ''
                            },
                            "theme": {
                                "color": "#3399cc"
                            }
                        };
                        var rzp1 = new Razorpay(options);
                            rzp1.open();
                    }
                });
            

        });
});
</script>
    
@endsection