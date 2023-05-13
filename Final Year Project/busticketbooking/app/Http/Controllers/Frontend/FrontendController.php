<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Schedule;
use App\Models\Coupon;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Route;


class FrontendController extends Controller
{
        
    public function index()
    {
        $coupon = Coupon::where('status', '1')->get();
        $current_date = Carbon::now();
        $current_date->toDateTimeString();
        $schedule = Schedule::all();
        return view('frontend.index', compact('schedule', 'coupon', 'current_date'));
    }
}
