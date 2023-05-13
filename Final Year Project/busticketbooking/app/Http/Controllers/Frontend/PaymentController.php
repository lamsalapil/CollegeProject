<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Payment;
use Carbon\Carbon;
// use Session;


class PaymentController extends Controller
{
    public function index()
    {
        return view('frontend.map.mapSchedules');
    }

    public function display($id)
    {
        $payment = Booking::findOrFail($id);
        
        return view('frontend.displayPayment', [
            'payment' => $payment,
        ]);
    }

    public function payment(Request $request, $id)
    {     
            $payment = Booking::findOrFail($id);
            $checkout = Payment::create([
                'booking_id'=> $payment,
                'payment_date' => Carbon::now(),
                'payment_method' => $request->input('payment_method'),
                'payment_id' => $request->input('payment_id'),
                'total'=> $request->total,

            ]);
            return redirect('/schedules')->with('status', 'Payment Successfully');
    }
}
