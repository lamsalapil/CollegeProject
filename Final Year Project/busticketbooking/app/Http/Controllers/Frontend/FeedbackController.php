<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bus;
use App\Models\Feedback;
use App\Models\Booking;
use App\Models\Schedule;
use Illuminate\Support\Facades\Auth;


class FeedbackController extends Controller
{
    public function addFeedback(Request $request)
    {
        $bus_id = $request->input('bus_ids');
        // Check sản phẩm có tồn tại 
        $bus = Bus::where('id', $bus_id)->where('bus_status', '1')->first();
        
        // Nếu bus tồn tại thì bắt đầu lấy input review từ người dùng
        if ($bus) {
            $user_review = $request->input('user_review');
            $new_review = Feedback::create([
                'user_id' => Auth::id(),
                'bus_id' => $bus_id,
                'user_feedback' => $user_review,
            ]);
            if ($new_review) {
                return redirect()->back()->with('status', 'Thank you for writting a review');
            }
        } else {
            return redirect()->back()->with('error', 'This bus does not exist');
        }
    }
}
