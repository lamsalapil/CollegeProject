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

		/* rating */
		.rating-css div {
			color: #ffe400;
			font-size: 30px;
			font-family: sans-serif;
			font-weight: 800;
			text-align: center;
			text-transform: uppercase;
			padding: 20px 0;
		}

		.rating-css input {
			display: none;
		}

		.rating-css input+label {
			font-size: 60px;
			text-shadow: 1px 1px 0 #8f8420;
			cursor: pointer;
		}

		.rating-css input:checked+label~label {
			color: #b4afaf;
		}

		.rating-css label:active {
			transform: scale(0.8);
			transition: 0.3s ease;
		}

		/* End of Star Rating */

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
	<div class="hero-wrap js-fullheight"
	style="background-image: url('https://images.unsplash.com/photo-1633613286991-611fe299c4be?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1470&q=80');">
		<div class="overlay"></div>
		<div class="container">
			<div class="row no-gutters slider-text js-fullheight align-items-center justify-content-center"
				data-scrollax-parent="true">
				<div class="col-md-9 text-center ftco-animate" data-scrollax=" properties: { translateY: '70%' }">
					<p class="breadcrumbs" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }"><span
							class="mr-2"><a href="{{url('/')}}">Home</a></span> <span>Rating</span></p>
					<h1 class="mb-3 bread" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }">Ratings</h1>
				</div>
			</div>
		</div>
	</div>
	<section class="ftco-about d-md-flex">
    	<div class="one-half img">
			<div id="carouselExampleControls{{$schedule->id}}" class="carousel slide" data-ride="carousel">
				<div class="carousel-inner">
					@php $i = 1; @endphp
					@foreach ($images_bus as $img)
					<div class="carousel-item {{$i == '1' ? 'active' : ''}}">
					@php $i++; @endphp
					<img class="d-block w-100" src="{{asset($img)}}" alt="slide {{$i++}}">
					</div>
					@endforeach
				</div>
				<a class="carousel-control-prev" href="#carouselExampleControls{{$schedule->id}}" role="button" data-slide="prev">
					<span class="carousel-control-prev-icon" aria-hidden="true"></span>
					<span class="sr-only">Previous</span>
				</a>
				<a class="carousel-control-next" href="#carouselExampleControls{{$schedule->id}}" role="button" data-slide="next">
					<span class="carousel-control-next-icon" aria-hidden="true"></span>
					<span class="sr-only">Next</span>
				</a>
			</div>
		</div>
    	<div class="one-half ftco-animate">
        <div class="heading-section ftco-animate ">
          <h2 class="mb-4 text-secondary">Rate {{$schedule->bus->bus_name}}</h2>
		  <!-- Button trigger modal -->
		  	@if($booking)
				<button type="button" class="btn btn-outline-secondary" data-toggle="modal" data-target="#exampleModal">
				Write Feedback
				</button>
			@else
				<div class="card card-body bg-warning text-white mt-2">
					You need to experience the product to be able to give Feedback				
				</div>
			@endif
        </div>
		<hr/>
		@if($booking)
        <div class="card text-white border-success mb-3">
			<div class="card-body">
				<form action="{{url('/add-rating')}}" method="POST">
					@csrf
					<input type="hidden" name="bus_id" value="{{$schedule->bus_id}}">
					{{-- Rating bus --}}
					<div class="rating-css">
					<div class="star-icon">
					@if($user_rating)
					@for($i = 1; $i <= $user_rating->stars_rating; $i++)
						<input type="radio" value="{{$i}}" name="bus_rating" checked id="rating{{$i}}">
						<label for="rating{{$i}}" class="fa fa-star"></label>
						@endfor
							@for($j = $user_rating->stars_rating+1; $j <= 5; $j++)
							<input type="radio" value="{{$j}}" name="bus_rating" id="rating{{$j}}">
							<label for="rating{{$j}}" class="fa fa-star"></label>
						@endfor
						@else
							<input type="radio" value="1" name="bus_rating" id="rating1">
								<label for="rating1" class="fa fa-star"></label>
							<input type="radio" value="2" name="bus_rating" id="rating2">
								<label for="rating2" class="fa fa-star"></label>
							<input type="radio" value="3" name="bus_rating" id="rating3">
								<label for="rating3" class="fa fa-star"></label>
							<input type="radio" value="4" name="bus_rating" id="rating4">
								<label for="rating4" class="fa fa-star"></label>
							<input type="radio" value="5" name="bus_rating" id="rating5">
								<label for="rating5" class="fa fa-star"></label>
						@endif
						<button type="submit" class="btn btn-primary">Submit</button>
				</form>
			</div>
		</div>
		@else
			<div class="card card-body bg-warning text-white mt-2">
					You need to experience the product to be able to give Rating			
				</div>
		@endif
	</section>
			<!-- Modal -->
			<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<form action="{{url('/add-feedback')}}" method="POST">
                @csrf
					<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">{{$schedule->bus->bus_name}}</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<input type="hidden" name="bus_ids" value="{{$schedule->bus_id}}">
                                <textarea class="form-control" name="user_review" id="" rows="6" placeholder="Write a review"></textarea>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-outline-info">Submit Review</button>
					</div>
				</div>
				</form>
			</div>
			</div>
		{{-- Show sum of rating --}}
		<div class="text-center">
					{{-- Create variable php --}}
					@php
						$ratenum = number_format($rating_value)
					@endphp
					<div class="rating">
						@for($i = 1; $i <= $ratenum; $i++)
							<i class="fa fa-star checked"></i>
						@endfor
						@for($j = $ratenum+1; $j <= 5; $j++)
							<i class="fa fa-star"></i>
						@endfor
						<span>
						@if($ratings->count() > 0)
							{{$ratings->count()}} Ratings
						@else
							No Rating
						@endif
						</span>
						</div>
						</div>
					</div>
		</div>
		<hr/>
		<div class="text-center">
			@foreach ($reviews as $item)  
                            <div class="user-review">
                                <label class="font-weight-bold" for="">{{$item->user->name}}</label>
                                <br>
                                @if($item->rating)
                                    @php 
                                        $user_rated = $item->rating->stars_rating
                                    @endphp
                                    @for($i = 1; $i <= $user_rated; $i++)
                                        <i class="fa fa-star checked"></i>
                                    @endfor
                                    @for($j = $user_rated+1; $j <= 5; $j++)
                                        <i class="fa fa-star"></i>
                                    @endfor
                                @endif
                                <small>Reviewed on {{$item->created_at->format('d M Y')}}</small>
                                <p>
                                    {{$item->user_feedback}}
                                </p>
                            </div>
            @endforeach
		</div>
@endsection