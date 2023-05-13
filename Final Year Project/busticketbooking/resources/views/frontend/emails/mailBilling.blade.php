<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</head>
<body>

<div class="card text-center mb-3" style="max-width: 540px;">
  <div class="row g-0">
    <div class="col-md-8">
      <div class="card-body">
        <h1 class="card-title">Thank for your Booking</h1>
        <p class="card-text">Name: {{$booking->user->name}}</p>
        <p class="card-text">Booking Date: {{$booking->booking_date}}</p>
        <p class="card-text">Bus Name: {{$schedule->bus->bus_name}}</p>
        <p class="card-text">Start Destination: {{$schedule->start_dest->name}}</p>
        <p class="card-text">Destination: {{$schedule->destination->name}}</p>
        <p class="card-text">Start Date: {{$schedule->start_at}}</p>
        <hr/>
        <p class="card-text">Total: {{$booking->total_price}}USD</p>
        <p class="card-text">Payment Method: {{$booking->payment_method}}</p>
      </div>
    </div>
  </div>
</div>
</body>
