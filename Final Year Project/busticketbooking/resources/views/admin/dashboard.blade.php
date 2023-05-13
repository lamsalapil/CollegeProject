@extends('layouts.admin')

@section('content')
		<!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
			<h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
		</div>
    	        <div class="row">
                        <!-- Total bus -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Bus</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$bus}}</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-bus fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                User</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$user}}</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-user fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Earnings (Monthly)</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">${{$total_price_monthly}}</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Schedule Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-secondary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Schedule</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$schedule}}</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>                        
                </div>
                @if(auth()->user()->hasRole('admin'))
                <div class="row">
                    <div class="col-md-8 card">
                        <canvas id="myLineChart"></canvas>
                    </div>
                    <div class="col-md-4 card">
                        <canvas id="myPieChart"></canvas>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-5 card">
                        <canvas id="paymentMethodUsedChart"></canvas>
                    </div>
                    <div class="col-md-7 card">
                        <canvas id="userRegisterMonthlyChart"></canvas>
                    </div>
                </div>
                @endif
@endsection
@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
    <script>
        const ctx4 = document.getElementById('userRegisterMonthlyChart');
        var data4s = <?php echo json_encode($total_user)?>;
        const data4 = {
            labels: ['January', 'February', 'March', 'April', 'May', 'June', 
                    'July', 'August', 'September', 'October', 'November','December'],
            datasets: [{
                        label: 'New User Registered',
                        data: data4s,
                        borderColor: 'rgb(75, 192, 192)',
                        fill: false,
                        tension: 0.2
                }]
        }
         var option4 = {
                responsive: true,
                title: {
                    display: true,
                    position: "top",
                    text: "New User registered by monthly",
                    fontSize: 18,
                    fontColor: "#111"
                },
                legend: {
                    display: true,
                    position: "bottom",
                    labels: {
                        fontColor: "#333",
                        fontSize: 16,
                        
                    }
                }
        };
        const config4 = {
                type: 'line',
                data: data4,
                options:option4
                };
        const newuser = new Chart(ctx4,config4);


        //Payment method chart
        const ctx3 = document.getElementById('paymentMethodUsedChart');
        const data3 = {
                    labels: [
                        'Paypal',
                        'Razorpay',
                        'Cash'
                    ],
                    datasets: [{
                        label: 'My First Dataset',
                        data: [{{$paypal}}, {{$razorpay}}, {{$cod}}],
                        backgroundColor: [
                        'rgb(255, 99, 132)',
                        'rgb(54, 162, 235)',
                        'rgb(255, 205, 86)'
                        ],
                        hoverOffset: 4
                    }]
                    };
        var option3 = {
                responsive: true,
                title: {
                    display: true,
                    position: "top",
                    text: "Payment Method used",
                    fontSize: 18,
                    fontColor: "#111"
                },
                legend: {
                    display: true,
                    position: "bottom",
                    labels: {
                        fontColor: "#333",
                        fontSize: 16
                    }
                }
        };
        const config3 = {
                type: 'doughnut',
                data: data3,
                options:option3
                };
        const myDonutChart = new Chart(ctx3,config3);
        


        //Line Chart
        const ctx2 = document.getElementById('myLineChart').getContext('2d');
        const colorgradient = ctx2.createLinearGradient(0, 0, 0, 400);
        colorgradient.addColorStop(0, 'lime');
        colorgradient.addColorStop(0, 'rgba(153, 102, 255, 0.2)');


        var datas = <?php echo json_encode($total_in_months)?>;

        var months = <?php echo json_encode($months)?>;
        const data2 = {
        labels: months,
        datasets: [{
                    label: 'Total amount',
                    backgroundColor: colorgradient,
                    borderColor: 'rgb(54, 162, 235)',
                    data: datas,
                    fill: true,
            },]
        };
        //options
        var option2 = {
                responsive: true,
                title: {
                    display: true,
                    position: "top",
                    text: "Total amount booking by monthly",
                    fontSize: 18,
                    fontColor: "#111"
                },
                legend: {
                    display: true,
                    position: "bottom",
                    labels: {
                        fontColor: "#333",
                        fontSize: 16
                    }
                }
        };
        //plot to chart
            const config2 = {
                type: 'line',
                data: data2,
                options: option2
            };

        const myLineChart = new Chart(ctx2,config2);

        //Pie Chart
        const ctx = document.getElementById('myPieChart');
        //label for fields
        const labels = [
                'Male',
                'Female',
                'Other',
                
            ];
            const data = {
                labels: labels,
                datasets: [{
                    label: '',
                    backgroundColor: [
                    'rgb(255, 99, 132)',
                    'rgb(54, 162, 235)',
                    'rgb(255, 205, 86)'
                    ],
                    hoverOffset: 4,
                    //borderColor: 'rgb(255, 99, 132)',
                    data: [{{$count_gender_Male}},{{$count_gender_Female}},{{$count_gender_Other}}],
                },]
            };

            //options
            var options = {
                responsive: true,
                title: {
                    display: true,
                    position: "top",
                    text: "Gender",
                    fontSize: 18,
                    fontColor: "#111"
                },
                legend: {
                    display: true,
                    position: "bottom",
                    labels: {
                        fontColor: "#333",
                        fontSize: 16
                    }
                }
            };
            //plot to chart
            const config = {
                type: 'pie',
                data: data,
                options: options
            };

            const mypieChart = new Chart(ctx,config);
    </script>
@endsection