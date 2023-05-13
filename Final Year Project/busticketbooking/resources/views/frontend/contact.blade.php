@extends('layouts.frontend')
@section('content')
    <div class="hero-wrap js-fullheight" style="background-image: url('https://images.unsplash.com/photo-1553367989-1f8a5d29ee08?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1470&q=80');">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-center justify-content-center" data-scrollax-parent="true">
          <div class="col-md-9 text-center ftco-animate" data-scrollax=" properties: { translateY: '70%' }">
            <p class="breadcrumbs" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }"><span class="mr-2"><a href="index.html">Home</a></span> <span>Contact</span></p>
            <h1 class="mb-3 bread" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }">Contact</h1>
          </div>
        </div>
      </div>
    </div>

    <section class="ftco-section contact-section ftco-degree-bg">
      <div class="container">
        <div class="row d-flex mb-5 contact-info">
          <div class="col-md-12 mb-4">
            <h2 class="h4">Contact Information</h2>
          </div>
          <div class="w-100"></div>
          <div class="col-md-3">
            <p><span>Address:</span> Pokhara, Nepal</p>
          </div>
          <div class="col-md-3">
            <p><span>Phone:</span> <a href="tel://123456789">+ 9844455555</a></p>
          </div>
          <div class="col-md-3">
            <p><span>Email:</span> <a href="mailto:scottnguyen0412@gmail.com">userapil21@gmail.com</a></p>
          </div>
          <div class="col-md-3">
            <p><span>Website</span> <a href="#">yoursite.com</a></p>
          </div>
        </div>
        <div class="row block-9">
          <div class="col-md-6 order-md-last pr-md-5">
            <form action="{{url('/get-contact')}}" method="POST">
              @csrf
              <div class="form-group">
                <input type="text" class="form-control" placeholder="Your Name" name="name">
              </div>
              <div class="form-group">
                <input type="text" class="form-control" placeholder="Your Email" name="email">
              </div>
              <div class="form-group">
                <input type="text" class="form-control" placeholder="Subject" name="subject">
              </div>
              <div class="form-group">
                <textarea id="" cols="30" rows="7" class="form-control" placeholder="Message" name="messages"></textarea>
              </div>
              <div class="form-group">
                <button type="submit" class="btn btn-primary py-3 px-5">Send Message</button>
              </div>
            </form>
          </div>

          <div class="col-md-6">
          	<div id="map">
            </div>
          </div>
        </div>
      </div>
    </section>

		<section class="ftco-section-parallax">
      <div class="parallax-img d-flex align-items-center">
        <div class="container">
          <div class="row d-flex justify-content-center">
            <div class="col-md-7 text-center heading-section heading-section-white ftco-animate">
              <h2>Subcribe to our Newsletter</h2>
              <p>Far far away, behind the word mountains, far from the countries nepal and Consonantia, there live the blind texts. Separated they live in</p>
              <div class="row d-flex justify-content-center mt-5">
                <div class="col-md-8">
                  <form action="#" class="subscribe-form">
                    <div class="form-group d-flex">
                      <input type="text" class="form-control" placeholder="Enter email address">
                      <input type="submit" value="Subscribe" class="submit px-3">
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

@endsection

@section('scripts')
  <script>
    var mapCenter = [{{ config('Nepal.map_center_latitude') }},
                    {{ config('Nepal.map_center_longitude') }},
                ];
        var map = L.map('map').setView(mapCenter,10);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap'
            }).addTo(map);
        var marker = L.marker([16.1263,108.2373]).addTo(map);
        marker.bindPopup("<b>Hello Everyone!</b><br>This is pokhara city.").openPopup();
  </script>
@endsection