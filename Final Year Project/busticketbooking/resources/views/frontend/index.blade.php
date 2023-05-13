@extends('layouts.frontend')

@section('content')
	<div class="hero-wrap js-fullheight" style="background-image: url('https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Fbuskoticket.com%2Fassets%2Fimages%2F3.jpg&f=1&nofb=1&ipt=6923d6cca521908974a8445e256fe28a20074a4bd08c62389e967890fce9e0b0&ipo=images">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-center justify-content-start" data-scrollax-parent="true">
          <div class="col-md-9 ftco-animate mb-5 pb-5 text-center text-md-left" data-scrollax=" properties: { translateY: '70%' }">
            <h1 class="mb-4" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }">Travel <br>A new Place</h1>
            <p data-scrollax="properties: { translateY: '30%', opacity: 1.6 }">Find great places to stay, eat, shop, or visit from local experts</p>
          </div>
        </div>
      </div>
    </div>
	<section class="ftco-section justify-content-end ftco-search">
    	<div class="container-wrap ml-auto">
    		<div class="row no-gutters">
          <div class="col-md-12 nav-link-wrap">
            <div class="nav nav-pills justify-content-center text-center" id="v-pills-tab" role="tablist" aria-orientation="vertical">
              <!-- <a class="nav-link active" id="v-pills-1-tab" data-toggle="pill" href="#v-pills-1" role="tab" aria-controls="v-pills-1" aria-selected="true">Bus</a> -->

              {{-- <a class="nav-link" id="v-pills-2-tab" data-toggle="pill" href="#v-pills-2" role="tab" aria-controls="v-pills-2" aria-selected="false">Hotel</a> --}}

              {{-- <a class="nav-link" id="v-pills-3-tab" data-toggle="pill" href="#v-pills-3" role="tab" aria-controls="v-pills-3" aria-selected="false">Car Rent</a> --}}
            </div>
          </div>
          <div class="col-md-12 tab-wrap">
            
            <div class="tab-content p-4 px-5" id="v-pills-tabContent">

              <div class="tab-pane fade show active" id="v-pills-1" role="tabpanel" aria-labelledby="v-pills-nextgen-tab">
              	<form action="{{route('frontend.schedules')}}" class="search-destination" method="GET"> 
					@csrf
              		<div class="row">
              			<div class="col-md align-items-end">
              				<div class="form-group">
              					<label for="#">From</label>
	              				<div class="form-field">
	              					<div class="icon"><span class="icon-my_location"></span></div>
					                <input type="text" name="start_schedule" value="{{request()->input('start_destination_id')}}" class="form-control @error('start_schedule') is-invalid @enderror" placeholder="From">
					              </div>
								  	@if ($errors->has('start_schedule'))
										@error('start_schedule')
											<div class="alert alert-light text-danger"><strong>{{ $message }}</strong></div>
										@enderror
                        			@endif
				              </div>
              			</div>
              			<div class="col-md align-items-end">
              				<div class="form-group">
              					<label for="#">Where</label>
              					<div class="form-field">
	              					<div class="icon"><span class="icon-map-marker"></span></div>
					                {{-- <input type="text"  name="destination_schedule" class="form-control" placeholder="Where"> --}}
									<select name="destination_schedule" id="" class="form-control @error('destination_schedule') is-invalid @enderror" placeholder="Keyword search">
										<option value="" selected class="text-primary">--Select Destination--</option>
										@foreach ($schedule as $sche)
										<option value="{{$sche->destination_id}}" >{{$sche->destination->name}}</option>
										@endforeach
									</select>
					            </div>
									@if ($errors->has('destination_schedule'))
										@error('destination_schedule')
											<div class="alert alert-light text-danger"><strong>{{ $message }}</strong></div>
										@enderror
                        			@endif
				              </div>
              			</div>
						<div class="col-md align-items-end">
              				<div class="form-group">
              					<label for="#">Start Day</label>
              					<div class="form-field">
	              					<div class="icon"><span class="fas fa-calendar-alt"></span></div>
					                <input type="date" name="checkin_date" class="form-control @error('checkin_date') is-invalid @enderror">
					              </div>
								  @if ($errors->has('checkin_date'))
										@error('checkin_date')
											<div class="alert alert-light text-danger"><strong>{{ $message }}</strong></div>
										@enderror
                        			@endif
				              </div>
              			</div>
              			<div class="col-md align-self-end">
              				<div class="form-group">
              					<div class="form-field">
					                <input type="submit" value="Search" class="form-control btn btn-primary">
					              </div>
				              </div>
              			</div>
              		</div>
              	</form>
              </div>

              <div class="tab-pane fade" id="v-pills-2" role="tabpanel" aria-labelledby="v-pills-performance-tab">
              	<form action="#" class="search-destination">
              		<div class="row">
              			<div class="col-md align-items-end">
              				<div class="form-group">
              					<label for="#">Check In</label>
              					<div class="form-field">
	              					<div class="icon"><span class="icon-map-marker"></span></div>
					                <input type="text" class="form-control checkin_date" placeholder="Check In">
					              </div>
				              </div>
              			</div>
              			<div class="col-md align-items-end">
              				<div class="form-group">
              					<label for="#">Check Out</label>
              					<div class="form-field">
	              					<div class="icon"><span class="icon-map-marker"></span></div>
					                <input type="text" class="form-control checkout_date" placeholder="From">
					              </div>
				              </div>
              			</div>
              			<div class="col-md align-items-end">
              				<div class="form-group">
              					<label for="#">Guest</label>
              					<div class="form-field">
	              					<div class="select-wrap">
			                      <div class="icon"><span class="ion-ios-arrow-down"></span></div>
			                      <select name="" id="" class="form-control">
			                      	<option value="">1</option>
			                        <option value="">2</option>
			                        <option value="">3</option>
			                        <option value="">4</option>
			                        <option value="">5</option>
			                      </select>
			                    </div>
					              </div>
				              </div>
              			</div>
              			<div class="col-md align-self-end">
              				<div class="form-group">
              					<div class="form-field">
					                <input type="submit" value="Search" class="form-control btn btn-primary">
					              </div>
				              </div>
              			</div>
              		</div>
              	</form>
              </div>

              {{-- <div class="tab-pane fade" id="v-pills-3" role="tabpanel" aria-labelledby="v-pills-effect-tab">
              	<form action="#" class="search-destination">
              		<div class="row">
              			<div class="col-md align-items-end">
              				<div class="form-group">
              					<label for="#">Where</label>
              					<div class="form-field">
	              					<div class="icon"><span class="icon-map-marker"></span></div>
					                <input type="text" class="form-controlr" placeholder="Where">
					              </div>
				            	</div>
              			</div>
              			<div class="col-md align-items-end">
              				<div class="form-group">
              					<label for="#">Check In</label>
              					<div class="form-field">
	              					<div class="icon"><span class="icon-map-marker"></span></div>
					                <input type="text" class="form-control checkin_date" placeholder="Check In">
					              </div>
				              </div>
              			</div>
              			<div class="col-md align-items-end">
              				<div class="form-group">
              					<label for="#">Check Out</label>
              					<div class="form-field">
	              					<div class="icon"><span class="icon-map-marker"></span></div>
					                <input type="text" class="form-control checkout_date" placeholder="From">
					              </div>
				              </div>
              			</div>
              			<div class="col-md align-self-end">
              				<div class="form-group">
              					<div class="form-field">
					                <input type="submit" value="Search" class="form-control btn btn-primary">
					              </div>
				              </div>
              			</div>
              		</div>
              	</form>
              </div> --}}
            </div>
          </div>
        </div>
    	</div>
    </section>
	<section class="ftco-section bg-light">
    	<div class="container">
    		<div class="row">
    			<div class="col-md-4">
    				<div class="intro ftco-animate">
    					<h3><span>01</span> Travel</h3>
    					<p>A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth.</p>
    				</div>
    			</div>
    			<div class="col-md-4">
    				<div class="intro ftco-animate">
    					<h3><span>02</span> Experience</h3>
    					<p>A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth.</p>
    				</div>
    			</div>
    			<div class="col-md-4">
    				<div class="intro ftco-animate">
    					<h3><span>03</span> Relax</h3>
    					<p>A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth.</p>
    				</div>
    			</div>
    		</div>
    	</div>
    </section>
	<!-- <section class="ftco-section">
    	<div class="container">
			<div class="row justify-content-center mb-5 pb-3">
				<div class="col-md-7 heading-section text-center ftco-animate">
					<h2 class="mb-4" style="color:#EEA47FFF"><i class="fas fa-gift"></i> Voucher</h2>
				</div>
        	</div>    		
    	</div>
		<div class="container">
			<div class="coupon-carousel owl-carousel owl-theme">
				@foreach ($coupon as $list_coupon)
					@if($list_coupon->valid_until > $current_date)
					<div class="card" style="width: 23rem;">
						<div class="card-body">
							<h5 class="card-title text-center font-weight-bold">{{$list_coupon->name_coupon}}</h5>
							<h6 class="card-subtitle mb-2 text-muted">Price: {{$list_coupon->price_coupon}}$</h6>
							<p class="card-text">Time to start voucher: {{$list_coupon->valid_from}}</p>
							<p class="card-text">Time to expire voucher: {{$list_coupon->valid_until}}</p>
						</div>
						<div class="card-footer">
						<span class="badge text-bg-success" >
							Coupon Code: <input id="coupon_code{{$list_coupon->coupon_code}}" value="{{$list_coupon->coupon_code}}" readonly>
						<button class="btn" data-clipboard-target="#coupon_code{{$list_coupon->coupon_code}}">
							<i class="fas fa-copy"></i>
						</button>
						</span>
						{{-- <button class="btn btn-outline-primary" onClick="alert('Number')">Get Coupon</button> --}}
						</div>
					</div>
					@else
						<div class="alert alert-primary" role="alert">
							Voucher is currently not available! 
						</div>
					@endif
				@endforeach
			</div>
		</div>
	</section> -->
	
	{{-- Popular --}}
	<section class="ftco-section">
    	<div class="container">
			<div class="row justify-content-center mb-5 pb-3">
				<div class="col-md-7 heading-section text-center ftco-animate">
					<h2 class="mb-4">Popular routes in Nepal</h2>

				</div>
        	</div>    		
    	</div>
		<div class="container">
		<div class="row g-2">
			@foreach ($schedule as $route)
			<div class="col-4 p-3">
					<div class="card shadow bg-white rounded" style="width: 18rem;">
					<div class="card-body">
						<h5 class="card-title text-center font-weight-bold text-primary">Routing</h5>
						<a href="#" class="card-link"><i class='bx bx-map-pin'></i> {{$route->start_dest->name}}</a><br/>
						<i class="fa ml-1 text-info">&#x7c;</i><br/>
						<div class="text-warning"><i class="fa-solid fa-clock"></i> {{$route->estimated_arrival_time}}</div>
						<i class="fa ml-1 text-info">&#x7c;</i><br/>

						<a href="{{url('/')}}" class="card-link"><i class='bx bxs-map-pin' ></i> {{$route->destination->name}}</a>
					</div>
				</div>
			</div>
			@endforeach
		</div>
			<div class="text-center">
				<a href="{{url('/schedules')}}" class="text-primary h5 font-weight-bold"><u>Show all routes</u></a>
			</div>
	</section>
    <section class="ftco-section">
    	<div class="container">
			<div class="row justify-content-center mb-5 pb-3">
				<div class="col-md-7 heading-section text-center ftco-animate">
					<h2 class="mb-4">Most Popular Destination</h2>
				</div>
        	</div>    		
    	</div>
    	<!-- <div class="container-fluid">
    		<div class="row">
    			<div class="col-sm col-md-6 col-lg ftco-animate">
    				<div class="destination">
    					<a href="#" class="img img-2 d-flex justify-content-center align-items-center" style="background-image: url(https://www.telegraph.co.uk/content/dam/travel/Spark/Hayes-and-Jarvis/HayesJarvis-da-nang-night-getty.jpg);">
    						<div class="icon d-flex justify-content-center align-items-center">
    							<span class="icon-link"></span>
    						</div>
    					</a>
    					<div class="text p-3">
    						<div class="d-flex">
    							<div class="one">
		    						<h3><a href="#">Da Nang</a></h3>
		    						<p class="rate">
		    							<i class="icon-star"></i>
		    							<i class="icon-star"></i>
		    							<i class="icon-star"></i>
		    							<i class="icon-star"></i>
		    							<i class="icon-star-o"></i>
		    							<span>8 Rating</span>
		    						</p>
	    						</div>
	    						<div class="two">
	    							<span class="price">$200</span>
    							</div>
    						</div>
    						<p>Far far away, behind the word mountains, far from the countries</p>
    						<hr>
    						<p class="bottom-area d-flex">
    							<a href="https://goo.gl/maps/XMiy3a4xkuWkX9Js9"><i class="icon-map-o"></i> Da Nang, Viet Nam</a> 
    							<span class="ml-auto"><a href="{{url('/schedules')}}">Discover</a></span>
    						</p>
    					</div>
    				</div>
    			</div>
    			<div class="col-sm col-md-6 col-lg ftco-animate">
    				<div class="destination d-md-flex flex-column-reverse">
    					<a href="#" class="img img-2 d-flex justify-content-center align-items-center" style="background-image: url('https://bcp.cdnchinhphu.vn/Uploaded/hoangtrongdien/2021_09_16/thanh-pho-thu-duc-tp-ho-chi-minh-41120.jpg');">
    						<div class="icon d-flex justify-content-center align-items-center">
    							<span class="icon-link"></span>
    						</div>
    					</a>
    					<div class="text p-3">
    						<div class="d-flex">
    							<div class="one">
		    						<h3><a href="#">Ho Chi Minh</a></h3>
		    						<p class="rate">
		    							<i class="icon-star"></i>
		    							<i class="icon-star"></i>
		    							<i class="icon-star"></i>
		    							<i class="icon-star"></i>
		    							<i class="icon-star-o"></i>
		    							<span>8 Rating</span>
		    						</p>
	    						</div>
	    						<div class="two">
	    							<span class="price">$200</span>
    							</div>
    						</div>
    						<p>Far far away, behind the word mountains, far from the countries</p>
    						<hr>
    						<p class="bottom-area d-flex">
    							<a href="https://goo.gl/maps/94GPfhwTnXKQryuW6"><i class="icon-map-o"></i> Ho Chi Minh, Viet Nam</a> 
    							<span class="ml-auto"><a href="{{url('/schedules')}}">Discover</a></span>
    						</p>
    					</div>
    				</div>
    			</div>
    			<div class="col-sm col-md-6 col-lg ftco-animate">
    				<div class="destination">
    					<a href="#" class="img img-2 d-flex justify-content-center align-items-center" style="background-image: url('https://a.cdn-hotels.com/gdcs/production144/d1394/a304783d-6dc9-4bb2-9239-d124a16a154e.jpg');">
    						<div class="icon d-flex justify-content-center align-items-center">
    							<span class="icon-link"></span>
    						</div>
    					</a>
    					<div class="text p-3">
    						<div class="d-flex">
    							<div class="one">
		    						<h3><a href="#"Rate</a></h3>
		    						<p class="rate">
		    							<i class="icon-star"></i>
		    							<i class="icon-star"></i>
		    							<i class="icon-star"></i>
		    							<i class="icon-star"></i>
		    							<i class="icon-star-o"></i>
		    							<span>8 Rating</span>
		    						</p>
	    						</div>
	    						<div class="two">
	    							<span class="price">$200</span>
    							</div>
    						</div>
    						<p>Far far away, behind the word mountains, far from the countries</p>
    						{{-- <p class="days"><span>2 days 3 nights</span></p> --}}
    						<hr>
    						<p class="bottom-area d-flex">
    							<a href="https://goo.gl/maps/pGPcxr8Pc7H8GNG29"><i class="icon-map-o"></i> Ha Noi, Viet Nam</a> 
    							<span class="ml-auto"><a href="{{url('/schedules')}}">Discover</a></span>
    						</p>
    					</div>
    				</div>
    			</div>
    			<div class="col-sm col-md-6 col-lg ftco-animate">
    				<div class="destination d-md-flex flex-column-reverse">
    					<a href="#" class="img img-2 d-flex justify-content-center align-items-center" style="background-image: url(https://i0.wp.com/datvandon.net/wp-content/uploads/2019/11/vinh-ha-long-o-tinh-nao-viet-nam.jpeg?fit=960%2C720&ssl=1);">
    						<div class="icon d-flex justify-content-center align-items-center">
    							<span class="icon-link"></span>
    						</div>
    					</a>
    					<div class="text p-3">
    						<div class="d-flex">
    							<div class="one">
		    						<h3><a href="#">Rate</a></h3>
		    						<p class="rate">
		    							<i class="icon-star"></i>
		    							<i class="icon-star"></i>
		    							<i class="icon-star"></i>
		    							<i class="icon-star"></i>
		    							<i class="icon-star-o"></i>
		    							<span>8 Rating</span>
		    						</p>
	    						</div>
	    						<div class="two">
	    							<span class="price">$200</span>
    							</div>
    						</div>
    						<p>Far far away, behind the word mountains, far from the countries</p>
    						<hr>
    						<p class="bottom-area d-flex">
    							<a href="https://goo.gl/maps/vmAfiSRguDZVTvbQA"><i class="icon-map-o"></i></a> 
    							<span class="ml-auto"><a href="{{url('/schedules')}}">Discover</a></span>
    						</p>
    					</div>
    				</div>
    			</div>
    		</div>
    	</div> -->
    </section>
@endsection

@section('scripts')
	<script>
	$(document).ready(function(){
		$('.coupon-carousel').owlCarousel({
			loop:true,
			margin:20,
			nav:true,
			dots:false,
			responsive:{
				0:{
					items:1
				},
				600:{
					items:3
				},
				1000:{
					items:3
				}
			}
		})
		var Clipboard = new ClipboardJS('.btn');
		Clipboard.on('success', function(e) {
			console.info('Action:', e.action);
			toastr.success('Copied')

		});
  	})
	</script>
@endsection