@extends('layouts.frontend')
@section('custom-css')
	<style>
         .mall-slider-handles{
         margin-top: 50px;
         }
         .filter-container-1{
         display: flex;
         justify-content: center;
         margin-top: 60px;
         }
         .filter-container-1 input{
         border: 1px solid #ddd;
         width: 100%;
         text-align: center;
         height: 30px;
         border-radius: 5px;
         }
         .filter-container-1 button{
         background: #51a179;
         color:#fff;
         padding: 5px 20px;
         }
         .filter-container-1 button:hover{
         background: #2e7552;
         color:#fff;
         }
		.checkout-form label{
			font-size: 12px;
			font-weight: 700;
		}

		.checkout-form input{
			font-size: 14px;
			padding: 5px;
			font-weight: 400;
		}
		.checked{
			color: #ffe400;
		}
		.ui-menu{
			z-index: 3500;
		}

		.whatsapp-chat{
			bottom: 10px;
			left: 10px;
			position: fixed;
		}
      </style>
@endsection
@section('content')
<div class="hero-wrap js-fullheight"style="background-image: url('https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Fbuskoticket.com%2Fassets%2Fimages%2F3.jpg&f=1&nofb=1&ipt=6923d6cca521908974a8445e256fe28a20074a4bd08c62389e967890fce9e0b0&ipo=images">
	<div class="overlay"></div>
	<div class="container">
		<div class="row no-gutters slider-text js-fullheight align-items-center justify-content-center"
			data-scrollax-parent="true">
			<div class="col-md-9 text-center ftco-animate" data-scrollax=" properties: { translateY: '70%' }">
				<p class="breadcrumbs" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }"><span
						class="mr-2"><a href="{{url('/')}}">Home</a></span> <span>Schedules</span></p>
				<h1 class="mb-3 bread" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }">Schedules</h1>
			</div>
		</div>
	</div>
</div>
<section class="ftco-section">
	<div class="container">
		<div class="row">
			<div class="col-lg-3 sidebar order-md-last ftco-animate">
				<div class="sidebar-wrap ftco-animate">
					<h3 class="heading mb-4 font-weight-bold">Find Schedule</h3>
					@include('frontend.search.searchSchedule')
					<form action="{{route('frontend.schedules')}}" method="Get">
						@csrf
						<div class="mall-property">
							<div class="mall-property__label">
								<h3 class="heading mb-4 font-weight-bold">Price</h3>
								<a class="mall-property__clear-filter js-mall-clear-filter" href="javascript:;" data-filter="price" style="">
								</a> 
							</div>
							<div class="mall-slider-handles" data-start="{{ $filter_min_price ?? $min_price }}" data-end="{{ $filter_max_price ?? $max_price }}" data-min="{{ $min_price}}" data-max="{{ $max_price }}" data-target="price" style="width: 100%">
							</div>
							<div class="row filter-container-1">
								<div class="col-md-4">
								
								<input data-min="price" id="skip-value-lower" name="min_price" value="{{ $filter_min_price ?? $min_price }}" readonly>  
								</div>
								<div class="col-md-4">
								<input data-max="price" id="skip-value-upper" name="max_price" value="{{ $filter_max_price ?? $max_price }}" readonly>
								</div>
								<div class="col-md-4">
								<button type="submit" class="btn btn-sm">Filter</button>
								</div>
							</div>
						</div>
					</form>
				</div>

				<div class="sidebar-wrap ftco-animate">
					<h3 class="heading mb-4 font-weight-bold">Bus House</h3>
					@include('frontend.search.searchBusHouse')
				</div>

				<div class="sidebar-wrap ftco-animate">
					<h3 class="heading mb-4 font-weight-bold">Start Destination</h3>
					@include('frontend.search.searchStartDestination')
					{{-- <div class="form-check">
						<input type="checkbox" class="form-check-input" id="exampleCheck1">
						name of start destination
					</div> --}}
				</div>
				<div class="sidebar-wrap ftco-animate">
					<h3 class="heading mb-4 font-weight-bold">Destination</h3>
					@include('frontend.search.searchDestination')
				</div>

				<div class="sidebar-wrap ftco-animate">
					<h3 class="heading mb-4 font-weight-bold">Star Rating</h3>
					<form method="post" class="star-rating">
						<div class="form-check">
							<input type="checkbox" class="form-check-input" id="exampleCheck1">
							<label class="form-check-label" for="exampleCheck1">
								<p class="rate"><span><i class="icon-star"></i><i class="icon-star"></i><i
											class="icon-star"></i><i class="icon-star"></i><i
											class="icon-star"></i></span></p>
							</label>
						</div>
						<div class="form-check">
							<input type="checkbox" class="form-check-input" id="exampleCheck1">
							<label class="form-check-label" for="exampleCheck1">
								<p class="rate"><span><i class="icon-star"></i><i class="icon-star"></i><i
											class="icon-star"></i><i class="icon-star"></i><i
											class="icon-star-o"></i></span></p>
							</label>
						</div>
						<div class="form-check">
							<input type="checkbox" class="form-check-input" id="exampleCheck1">
							<label class="form-check-label" for="exampleCheck1">
								<p class="rate"><span><i class="icon-star"></i><i class="icon-star"></i><i
											class="icon-star"></i><i class="icon-star-o"></i><i
											class="icon-star-o"></i></span></p>
							</label>
						</div>
						<div class="form-check">
							<input type="checkbox" class="form-check-input" id="exampleCheck1">
							<label class="form-check-label" for="exampleCheck1">
								<p class="rate"><span><i class="icon-star"></i><i class="icon-star"></i><i
											class="icon-star-o"></i><i class="icon-star-o"></i><i
											class="icon-star-o"></i></span></p>
							</label>
						</div>
						<div class="form-check">
							<input type="checkbox" class="form-check-input" id="exampleCheck1">
							<label class="form-check-label" for="exampleCheck1">
								<p class="rate"><span><i class="icon-star"></i><i class="icon-star-o"></i><i
											class="icon-star-o"></i><i class="icon-star-o"></i><i
											class="icon-star-o"></i></span></p>
							</label>
						</div>
					</form>
				</div>
			</div><!-- END-->

			<div class="col-lg-9">
				<div class="font-weight-bold">
					Sort by:
					<a href="{{URL::current()}}" class="btn btn-primary">All</a>
					<a href="{{URL::current()."?sort=price_desc"}}" class="btn btn-success">Highest Price</a>
					<a href="{{URL::current()."?sort=price_asc"}}" class="btn btn-info">Lowest Price</a>
					<a href="{{URL::current()."?sort=newest"}}" class="btn btn-secondary text-white">Newest</a>
				</div>

				{{-- @foreach ($schedule as $sche) --}}
				@foreach ($schedules as $schedule_a)
				@if ($schedule_a->schedule->bus->number_of_seats != 0)	
				<div class="gx-5 mt-3">
					<div class="col mb-2">
						<div class="card mb-3 mt-3">
							<div class="row g-0">
								<div class="col-md-3">
									{{-- Get first image in multiple image --}}
									<img src="{{asset($schedule_a->images_bus[0])}}"
										class="img-fluid rounded-start mt-2" alt="...">
								</div>
								<div class="col-md-9">
									<div class="card-body">
										<h5 class="card-title font-weight-bold">
											{{$schedule_a->schedule->bus->bus_name}}
											<p class="text-secondary float-right">
												from US ${{$schedule_a->schedule->price_schedules}}
											</p>
										</h5>
										<small class="card-text">
										Date and Time: 	{{$schedule_a->schedule->start_at}}
											
										</small><br />
										<small class="card-text">{{$schedule_a->schedule->bus->number_of_seats}}
											Seats
										</small><br />
										{{-- Icon --}}
										<div class="mt-3">
											<div class="font-weight-bold"
												style="margin-left: 20px; display:flex; position:absolute; -webkit-box-align:center; line-height:20px;">
												{{$schedule_a->schedule->start_dest->name}}</div>
											<small
												style="font-size: 12px; position: absolute; margin-left:20px; line-height: 72px">{{$schedule_a->schedule->estimated_arrival_time}}</small>
											<svg class="TicketPC__LocationRouteSVG-sc-1mxgwjh-4 eKNjJr"
												xmlns="http://www.w3.org/2000/svg" width="14" height="74"
												viewBox="0 0 14 74">
												<path fill="none" stroke="#787878" stroke-linecap="round"
													stroke-width="2" stroke-dasharray="0 7" d="M7 13.5v46"></path>
												<g fill="none" stroke="#484848" stroke-width="3">
													<circle cx="7" cy="7" r="7" stroke="none"></circle>
													<circle cx="7" cy="7" r="5.5"></circle>
												</g>
												<path
													d="M7 58a5.953 5.953 0 0 0-6 5.891 5.657 5.657 0 0 0 .525 2.4 37.124 37.124 0 0 0 5.222 7.591.338.338 0 0 0 .506 0 37.142 37.142 0 0 0 5.222-7.582A5.655 5.655 0 0 0 13 63.9 5.953 5.953 0 0 0 7 58zm0 8.95a3.092 3.092 0 0 1-3.117-3.06 3.117 3.117 0 0 1 6.234 0A3.092 3.092 0 0 1 7 66.95z"
													fill="#787878"></path>
											</svg>
											<div class="font-weight-bold"
												style="margin-left: 20px; display:flex; position: absolute; bottom:2px; -webkit-box-align:center; line-height:68px;">
												{{$schedule_a->schedule->destination->name}}</div>
										</div>
									</div>
								</div>
								<div class=" ml-3 mb-2">
									<a class="btn btn-gradient-danger dropdown-toggle" data-toggle="collapse"
										href="#{{$schedule_a->schedule->id}}" role="button" aria-expanded="false"
										aria-controls="collapseExample">
										Details Information
									</a>

									{{-- Booking --}}
									<button class="btn btn-outline-success rounded-0" type="button" data-toggle="collapse" data-target="#collapseExample{{$schedule_a->schedule->id}}" aria-expanded="false" aria-controls="collapseExample">
										Book now
									</button>
									<div class="collapse" id="collapseExample{{$schedule_a->schedule->id}}">
										<div class="card-body d-print-none">
											<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
												<li class="nav-item">
													<a class="nav-link active" id="seats-tab" data-toggle="pill" href="#seats{{$schedule_a->schedule->id}}" role="tab" aria-controls="pills-home" aria-selected="true"><i class="fa-solid fa-1"></i> Choose the seats</a>
												</li>
												<li class="nav-item">
													<a class="nav-link" id="pick-tab" data-toggle="pill" href="#pick{{$schedule_a->schedule->id}}" role="tab" aria-controls="pills-profile" aria-selected="false"><i class="fa-solid fa-2"></i> Pick up & Drop off</a>
												</li>
											</ul>
												<form action="{{url('schedules/show-map/'.$schedule_a->schedule->id)}}" method="GET">
												@csrf
												<div class="tab-content" id="pills-tabContent">
													<div class="tab-pane fade show active" id="seats{{$schedule_a->schedule->id}}" role="tabpanel" aria-labelledby="pills-home-tab">
														<div class="alert alert-primary d-flex align-items-center" role="alert">
															<div class="font-weight-bold" d-inline>
																<i class='bx bxs-badge-check h4' style='color:#5672c1'></i>
																We make sure you are seated in the seat of your choice.
															</div>
														</div>
														{{-- Choose seats --}}
														<div class="amount">
															<strong>Enter the number of seats: </strong>
															<input type="number" min="0" name="choose_seats" 
																	value="{{request()->input('choose_seats')}}"
																	placeholder="Quantity of seats" 
																	class="text-secondary rounded border border-success font-weight-bold choose_seats">
														</div>
														<div class="cost d-none" value="0">{{$schedule_a->schedule->price_schedules}}</div>
														<hr/>
														<div class="font-weight-bold ">Total: <p class="total d-inline-block"></p>$
															<a class="btn btn-primary btnNextPage"><i class="fas fa-arrow-alt-circle-right"></i> Next</a>
														</div>
													</div>
													</form>
													{{-- Show map --}}
													<div class="tab-pane fade" id="pick{{$schedule_a->schedule->id}}" role="tabpanel" aria-labelledby="pills-profile-tab">
														<div class="alert alert-primary d-flex align-items-center" role="alert">
															<div class="font-weight-bold" d-inline>
																<i class="fa-sharp fa-solid fa-shield-check"></i>
																Pick you up and drop you off exactly where you selected, change whenever you want.
															</div>
														</div>
														<a href="{{url('/schedules/show-map/'.$schedule_a->schedule->id)}}" class="btn text-white font-weight-bold" style="background-color: #DDC3A5"><i class="fa-solid fa-location-dot"></i> View Location On Map</a>
														<button type="submit" class="btn btn-outline-primary">Save</button>
														<a class="btn btn-success text-white btnPreviousPage"><i class="fas fa-arrow-alt-circle-left"></i> Back</a>
													</div>
													</div>
												</div>
									</div>
									<div class="collapse" id="{{$schedule_a->schedule->id}}">
										<div class="card-body">
											<ul class="nav nav-tabs" id="myTab" role="tablist">
												{{-- Image --}}
												<li class="nav-item">
													<a class="nav-link active" id="image-tab" data-toggle="tab"
														href="#image{{$schedule_a->schedule->id}}" role="tab"
														aria-controls="image" aria-selected="true">Image Bus</a>
												</li>
												<li class="nav-item">
													<a class="nav-link" id="amenities-tab" data-toggle="tab"
														href="#amenities{{$schedule_a->schedule->id}}" role="tab"
														aria-controls="amenities" aria-selected="false">Amenities</a>
												</li>
												<li class="nav-item">
													<a class="nav-link" id="policies-tab" data-toggle="tab"
														href="#policies" role="tab" aria-controls="policies"
														aria-selected="false">Policies</a>
												</li>
												<li class="nav-item">
													<a class="nav-link" id="rating-tab" data-toggle="tab" href="#rating{{$schedule_a->schedule->id}}"
														role="tab" aria-controls="rating"
														aria-selected="false">Rating</a>
												</li>
											</ul>

											<div class="tab-content" id="myTabContent">
												<div class="tab-pane fade show active"
													id="image{{$schedule_a->schedule->id}}" role="tabpanel"
													aria-labelledby="image-tab">
													<br />
													<div id="carouselExampleControls{{$schedule_a->schedule->id}}"
														class="carousel slide" data-ride="carousel">
														<div class="carousel-inner">
															{{-- Cho biến i = 1 --}}
															@php $i = 1; @endphp
															@foreach ($schedule_a->images_bus as $img)
															{{-- Sau Mỗi vòng lặp thì $i tăng thêm 1 đơn vị và check
															active carousel --}}
															<div class="carousel-item {{$i == '1' ? 'active' : ''}}">
																@php $i++; @endphp
																<img class="d-block w-100" src="{{asset($img)}}"
																	alt="slide {{$i++}}">
															</div>
															@endforeach
														</div>
														<a class="carousel-control-prev"
															href="#carouselExampleControls{{$schedule_a->schedule->id}}"
															role="button" data-slide="prev">
															<i class="fa-solid fa-circle-arrow-left text-success font-weight-bold"
																style="font-size: 20px" aria-hidden="true"></i>
															<span class="sr-only ">Previous</span>
														</a>
														<a class="carousel-control-next"
															href="#carouselExampleControls{{$schedule_a->schedule->id}}"
															role="button" data-slide="next">
															<i class="fa-solid fa-circle-arrow-right text-success font-weight-bold"
																style="font-size: 20px" aria-hidden="true"></i>
															<span class="sr-only">Next</span>
														</a>
													</div>
												</div>
												<div class="tab-pane fade" id="amenities{{$schedule_a->schedule->id}}"
													role="tabpanel" aria-labelledby="amenities-tab">
													<br />
													<div class="">
														<ul class="list-group list-group-flush">
															<li class="list-group-item">
																<i class="fa-solid fa-shield-virus mb-4"
																	style="color: #dec3c3 "> Covid-19 safety
																	guaramtee</i>
																<div>
																	For customers on Covid-19, this is a service for
																	safety protection.
																	Bus Booking will work with bus companies to provide
																	the best safety protections and measures possible:
																	<p>- Check the temperature before getting on the
																		bus.</p>
																	<p>- Hand sanitizer that is always with you</p>
																	<p>- Suggest Donning a Face Mask</p>
																	<p>- Cleaning the Bus</p>
																	<p>- The driver and employees have received Covid-19
																		vaccinations.</p>
																</div>
															</li>
															<li class="list-group-item">
																<i class="fa-solid fa-language mb-4"
																	style="color: #dec3c3 "> English Speaking Staff</i>
																<div>
																	Bus Company's staffs can speak english
																</div>
															</li>
															<li class="list-group-item">
																<i class="fa-solid fa-syringe mb-4"
																	style="color: #dec3c3"> Covid-19 vaccinated
																	Staff</i>
																<div>
																	Driver and staff have been vaccinated against
																	Covid-19
																</div>
															</li>
															<li class="list-group-item">
																<i class="fa-solid fa-wifi mb-4" style="color: #dec3c3">
																	Wifi</i>
																<div>
																	Bus Company have equipted Wifi on bus
																</div>
															</li>
															<li class="list-group-item">
																<i class="fa-solid fa-snowflake mb-4"
																	style="color: #dec3c3"> Air Conditions</i>
																<div>
																	Bus Company have equipted air condition on bus
																</div>
															</li>
															<li class="list-group-item">
																<i class="fas fa-glass-martini-alt"
																	style="color: #dec3c3"> Water</i>
																<div>
																	Customers will served water on bus
																</div>
															</li>
														</ul>
													</div>
												</div>
												<div class="tab-pane fade" id="policies" role="tabpanel"
													aria-labelledby="policies-tab">Policies </div>

												<div class="tab-pane fade" id="rating{{$schedule_a->schedule->id}}" role="tabpanel"
													aria-labelledby="rating-tab">
													<br/>
													<a href="{{url('show-rating/'.$schedule_a->schedule->id)}}" class="btn btn-outline-success">View Rating {{$schedule_a->schedule->bus->bus_name}}</a>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				@elseif($schedule_a->schedule->bus->number_of_seats == 0)
					<div class="gx-5 mt-3">
					<div class="col mb-2">
						<div class="card mb-3 mt-3">
							<div class="row g-0">
								<div class="col-md-3">
									{{-- Get first image in multiple image --}}
									<img src="{{asset($schedule_a->images_bus[0])}}"
										class="img-fluid rounded-start mt-2" alt="...">
								</div>
								<div class="col-md-9">
									<div class="card-body">
										<h5 class="card-title font-weight-bold">
											{{$schedule_a->schedule->bus->bus_name}}
											<p class="text-secondary float-right">
												from US ${{$schedule_a->schedule->price_schedules}}
											</p>
										</h5>
										<small class="card-text btn btn-primary text-white">
											Thanks for taking a look at our schedule but now the bus is full.<br/> Please, come back later!
										</small><br />
										{{-- Icon --}}
										<div class="mt-3">
											<div class="font-weight-bold"
												style="margin-left: 20px; display:flex; position:absolute; -webkit-box-align:center; line-height:20px;">
												{{$schedule_a->schedule->start_dest->name}}</div>
											<small
												style="font-size: 12px; position: absolute; margin-left:20px; line-height: 72px">{{$schedule_a->schedule->estimated_arrival_time}}</small>
											<svg class="TicketPC__LocationRouteSVG-sc-1mxgwjh-4 eKNjJr"
												xmlns="http://www.w3.org/2000/svg" width="14" height="74"
												viewBox="0 0 14 74">
												<path fill="none" stroke="#787878" stroke-linecap="round"
													stroke-width="2" stroke-dasharray="0 7" d="M7 13.5v46"></path>
												<g fill="none" stroke="#484848" stroke-width="3">
													<circle cx="7" cy="7" r="7" stroke="none"></circle>
													<circle cx="7" cy="7" r="5.5"></circle>
												</g>
												<path
													d="M7 58a5.953 5.953 0 0 0-6 5.891 5.657 5.657 0 0 0 .525 2.4 37.124 37.124 0 0 0 5.222 7.591.338.338 0 0 0 .506 0 37.142 37.142 0 0 0 5.222-7.582A5.655 5.655 0 0 0 13 63.9 5.953 5.953 0 0 0 7 58zm0 8.95a3.092 3.092 0 0 1-3.117-3.06 3.117 3.117 0 0 1 6.234 0A3.092 3.092 0 0 1 7 66.95z"
													fill="#787878"></path>
											</svg>
											<div class="font-weight-bold"
												style="margin-left: 20px; display:flex; position: absolute; bottom:2px; -webkit-box-align:center; line-height:68px;">
												{{$schedule_a->schedule->destination->name}}</div>
										</div>
									</div>
								</div>
								<div class=" ml-3 mb-2">
									<a class="btn btn-gradient-danger dropdown-toggle" data-toggle="collapse"
										href="#{{$schedule_a->schedule->id}}" role="button" aria-expanded="false"
										aria-controls="collapseExample">
										Details Information
									</a>

									{{-- Booking --}}
									<button class="btn btn-outline-success rounded-0" type="button" data-toggle="collapse" data-target="#collapseExample{{$schedule_a->schedule->id}}" aria-expanded="false" aria-controls="collapseExample" disabled>
										Book now
									</button>
									<div class="collapse" id="collapseExample{{$schedule_a->schedule->id}}">
										<div class="card-body d-print-none">
											<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
												<li class="nav-item">
													<a class="nav-link active" id="seats-tab" data-toggle="pill" href="#seats{{$schedule_a->schedule->id}}" role="tab" aria-controls="pills-home" aria-selected="true"><i class="fa-solid fa-1"></i> Choose the seats</a>
												</li>
												<li class="nav-item">
													<a class="nav-link" id="pick-tab" data-toggle="pill" href="#pick{{$schedule_a->schedule->id}}" role="tab" aria-controls="pills-profile" aria-selected="false"><i class="fa-solid fa-2"></i> Pick up & Drop off</a>
												</li>
											</ul>
												<form action="{{url('schedules/show-map/'.$schedule_a->schedule->id)}}" method="GET">
												@csrf
												<div class="tab-content" id="pills-tabContent">
													<div class="tab-pane fade show active" id="seats{{$schedule_a->schedule->id}}" role="tabpanel" aria-labelledby="pills-home-tab">
														<div class="alert alert-primary d-flex align-items-center" role="alert">
															<div class="font-weight-bold" d-inline>
																<i class='bx bxs-badge-check h4' style='color:#5672c1'></i>
																We make sure you are seated in the seat of your choice.
															</div>
														</div>
														{{-- Choose seats --}}
														<div class="amount">
															<strong>Enter the number of seats: </strong>
															<input type="number" min="0" name="choose_seats" 
																	value="{{request()->input('choose_seats')}}"
																	placeholder="Quantity of seats" 
																	class="text-secondary rounded border border-success font-weight-bold choose_seats">
														</div>
														<div class="cost d-none" value="0">{{$schedule_a->schedule->price_schedules}}</div>
														<hr/>
														<div class="font-weight-bold ">Total: <p class="total d-inline-block"></p>$
															<a class="btn btn-primary btnNextPage"><i class="fas fa-arrow-alt-circle-right"></i> Next</a>
														</div>
													</div>
													</form>
													{{-- Show map --}}
													<div class="tab-pane fade" id="pick{{$schedule_a->schedule->id}}" role="tabpanel" aria-labelledby="pills-profile-tab">
														<div class="alert alert-primary d-flex align-items-center" role="alert">
															<div class="font-weight-bold" d-inline>
																<i class="fa-sharp fa-solid fa-shield-check"></i>
																Pick you up and drop you off exactly where you selected, change whenever you want.
															</div>
														</div>
														<a href="{{url('/schedules/show-map/'.$schedule_a->schedule->id)}}" class="btn text-white font-weight-bold" style="background-color: #DDC3A5"><i class="fa-solid fa-location-dot"></i> View Location On Map</a>
														<button type="submit" class="btn btn-outline-primary">Save</button>
														<a class="btn btn-success text-white btnPreviousPage"><i class="fas fa-arrow-alt-circle-left"></i> Back</a>
													</div>
													</div>
												</div>
									</div>
									<div class="collapse" id="{{$schedule_a->schedule->id}}">
										<div class="card-body">
											<ul class="nav nav-tabs" id="myTab" role="tablist">
												{{-- Image --}}
												<li class="nav-item">
													<a class="nav-link active" id="image-tab" data-toggle="tab"
														href="#image{{$schedule_a->schedule->id}}" role="tab"
														aria-controls="image" aria-selected="true">Image Bus</a>
												</li>
												<li class="nav-item">
													<a class="nav-link" id="amenities-tab" data-toggle="tab"
														href="#amenities{{$schedule_a->schedule->id}}" role="tab"
														aria-controls="amenities" aria-selected="false">Amenities</a>
												</li>
												<li class="nav-item">
													<a class="nav-link" id="policies-tab" data-toggle="tab"
														href="#policies" role="tab" aria-controls="policies"
														aria-selected="false">Policies</a>
												</li>
												<li class="nav-item">
													<a class="nav-link" id="rating-tab" data-toggle="tab" href="#rating{{$schedule_a->schedule->id}}"
														role="tab" aria-controls="rating"
														aria-selected="false">Rating</a>
												</li>
											</ul>

											<div class="tab-content" id="myTabContent">
												<div class="tab-pane fade show active"
													id="image{{$schedule_a->schedule->id}}" role="tabpanel"
													aria-labelledby="image-tab">
													<br />
													<div id="carouselExampleControls{{$schedule_a->schedule->id}}"
														class="carousel slide" data-ride="carousel">
														<div class="carousel-inner">
															{{-- Cho biến i = 1 --}}
															@php $i = 1; @endphp
															@foreach ($schedule_a->images_bus as $img)
															{{-- Sau Mỗi vòng lặp thì $i tăng thêm 1 đơn vị và check
															active carousel --}}
															<div class="carousel-item {{$i == '1' ? 'active' : ''}}">
																@php $i++; @endphp
																<img class="d-block w-100" src="{{asset($img)}}"
																	alt="slide {{$i++}}">
															</div>
															@endforeach
														</div>
														<a class="carousel-control-prev"
															href="#carouselExampleControls{{$schedule_a->schedule->id}}"
															role="button" data-slide="prev">
															<i class="fa-solid fa-circle-arrow-left text-success font-weight-bold"
																style="font-size: 20px" aria-hidden="true"></i>
															<span class="sr-only ">Previous</span>
														</a>
														<a class="carousel-control-next"
															href="#carouselExampleControls{{$schedule_a->schedule->id}}"
															role="button" data-slide="next">
															<i class="fa-solid fa-circle-arrow-right text-success font-weight-bold"
																style="font-size: 20px" aria-hidden="true"></i>
															<span class="sr-only">Next</span>
														</a>
													</div>
												</div>
												<div class="tab-pane fade" id="amenities{{$schedule_a->schedule->id}}"
													role="tabpanel" aria-labelledby="amenities-tab">
													<br />
													<div class="">
														<ul class="list-group list-group-flush">
															<li class="list-group-item">
																<i class="fa-solid fa-shield-virus mb-4"
																	style="color: #dec3c3 "> Covid-19 safety
																	guaramtee</i>
																<div>
																	For customers on Covid-19, this is a service for
																	safety protection.
																	Bus Booking will work with bus companies to provide
																	the best safety protections and measures possible:
																	<p>- Check the temperature before getting on the
																		bus.</p>
																	<p>- Hand sanitizer that is always with you</p>
																	<p>- Suggest Donning a Face Mask</p>
																	<p>- Cleaning the Bus</p>
																	<p>- The driver and employees have received Covid-19
																		vaccinations.</p>
																</div>
															</li>
															<li class="list-group-item">
																<i class="fa-solid fa-language mb-4"
																	style="color: #dec3c3 "> English Speaking Staff</i>
																<div>
																	Bus Company's staffs can speak english
																</div>
															</li>
															<li class="list-group-item">
																<i class="fa-solid fa-syringe mb-4"
																	style="color: #dec3c3"> Covid-19 vaccinated
																	Staff</i>
																<div>
																	Driver and staff have been vaccinated against
																	Covid-19
																</div>
															</li>
															<li class="list-group-item">
																<i class="fa-solid fa-wifi mb-4" style="color: #dec3c3">
																	Wifi</i>
																<div>
																	Bus Company have equipted Wifi on bus
																</div>
															</li>
															<li class="list-group-item">
																<i class="fa-solid fa-snowflake mb-4"
																	style="color: #dec3c3"> Air Conditions</i>
																<div>
																	Bus Company have equipted air condition on bus
																</div>
															</li>
															<li class="list-group-item">
																<i class="fas fa-glass-martini-alt"
																	style="color: #dec3c3"> Water</i>
																<div>
																	Customers will served water on bus
																</div>
															</li>
														</ul>
													</div>
												</div>
												<div class="tab-pane fade" id="policies" role="tabpanel"
													aria-labelledby="policies-tab">Policies </div>

												<div class="tab-pane fade" id="rating{{$schedule_a->schedule->id}}" role="tabpanel"
													aria-labelledby="rating-tab">
													<br/>
													<a href="{{url('show-rating/'.$schedule_a->schedule->id)}}" class="btn btn-outline-success">View Rating {{$schedule_a->schedule->bus->bus_name}}</a>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				@endif
				@endforeach
				{{-- @endforeach --}}
			</div>
</section> <!-- .section -->
@endsection

@section('scripts')
	<script>
	$(function () {
           var $propertiesForm = $('.mall-category-filter');
           var $body = $('body');
           $('.mall-slider-handles').each(function () {
               var el = this;
               noUiSlider.create(el, {
                   start: [el.dataset.start, el.dataset.end],
                   connect: true,
                   tooltips: true,
                   range: {
                       min: [parseFloat(el.dataset.min)],
                       max: [parseFloat(el.dataset.max)]
                   },
                   pips: {
                       mode: 'range',
                       density: 20
                   }
               }).on('change', function (values) {
                   $('[data-min="' + el.dataset.target + '"]').val(values[0])
                   $('[data-max="' + el.dataset.target + '"]').val(values[1])
                   $propertiesForm.trigger('submit');
               });
           })
       })     

	$('.btnNextPage').click(function() {
		const nextTabLinkEl = $('.nav-pills .active').closest('li').next('li:first').find('a')[0];
		const nextTab = new bootstrap.Tab(nextTabLinkEl);
		nextTab.show();
		});
	$('.btnPreviousPage').click(function() {
		const prevTabLinkEl = $('.nav-pills .active').closest('li').prev('li:last').find('a')[0];
		const prevTab = new bootstrap.Tab(prevTabLinkEl);
		prevTab.show();
		});

	//Auto calculate price from input quality of user
	$('.amount > .choose_seats').on('input', updateTotal);
	function updateTotal(e){
	var amount = parseInt(e.target.value);
	
	if (!amount || amount < 0)
		return;
		
	var $parentRow = $(e.target).parent().parent();
	var cost = parseFloat($parentRow.find('.cost').text());
	var total = (cost * amount).toFixed(0);
	
	$parentRow.find('.total').text(total);
	}
	</script>
@endsection