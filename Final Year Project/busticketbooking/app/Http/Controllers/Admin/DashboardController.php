<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\User;
use App\Models\Booking;
use \stdClass;

class DashboardController extends Controller
{
    public function index()
    {
        $bus = DB::table('buses')->count();
        $user = User::where('role_id', '2')->count();
        $total_price_monthly = Booking::where('booking_status', '1')->sum('total_price');
        $schedule = DB::table('schdules')->count();
        $star_destination = DB::table('start_destination')->count();
        $destination = DB::table('destination')->count();
        $coupon = DB::table('coupons')->count();
        $booking = Booking::where('booking_status', '1')->count();

        $count_gender_Other = User::where('role_id', '2')->where('gender', 'O')->count(); 
        $count_gender_Male = User::where('role_id', '2')->where('gender', 'M')->count();
        $count_gender_Female = User::where('role_id', '2')->where('gender', 'F')->count();

        // Calculate total price booking by month
        $months = ['January', 'February', 'March', 'April', 'May', 'June', 
                    'July', 'August', 'September', 'October', 'November','December'];
        $total_in_months = array();
        // Loop 1 to 12
        for ($mon=1; $mon <= 12; $mon++) { 
            $total_in_month = Booking::where('booking_status', '1')->whereMonth('booking_date', $mon)->sum('total_price');
            array_push($total_in_months, $total_in_month);
        };

        // Total payment method used many
        $paypal = Booking::where('booking_status', '1')->where('payment_method', 'Paid by Paypal')->count();
        $razorpay = Booking::where('booking_status', '1')->where('payment_method', 'Paid by Razorpay')->count();
        $cod = Booking::where('booking_status', '1')->where('payment_method', 'COD')->count();

        // Total user registed in monthly
        $total_user = array();
        for ($monthly=1; $monthly < 12; $monthly++) { 
                $new_user_register = User::where('role_id', '2')
                                    ->whereMonth('created_at', $monthly)
                                    ->count();   
                array_push($total_user, $new_user_register);
        }
        return view('admin.dashboard', [
            'bus' => $bus,
            'user' => $user,
            'total_price_monthly' => $total_price_monthly,
            'schedule' =>  $schedule,
            'start_destination' => $star_destination,
            'destination' => $destination,
            'coupon' => $coupon,
            'booking' => $booking,
            'count_gender_Other' => $count_gender_Other,
            'count_gender_Male'=> $count_gender_Male,
            'count_gender_Female' => $count_gender_Female,
            'total_in_months'=> $total_in_months,
            'months' => $months,
            'paypal' => $paypal,
            'razorpay' => $razorpay,
            'cod' => $cod,
            'new_user_register'=>$new_user_register,
            'total_user' => $total_user,
        ]);
    }

}
