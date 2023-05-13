<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bus;
use App\Models\Booking;
use App\Models\Rating;
use Illuminate\Support\Facades\Auth;


class RatingController extends Controller
{
    public function addRatings(Request $request)
    {
        $stars_rated = $request->input('bus_rating');
        $bus_id = $request->input('bus_id');

        // Kiểm tra xe bus có tồn tại hay không hoặc bị ẩn bởi admin
        $bus_check = Bus::where('id', $bus_id)->where('bus_status', '1')->first();
        if ($bus_check) {
                // Check người dùng đã đánh giá sản phẩm chưa
                $exist_rating = Rating::where('user_id', Auth::id())->where('bus_id', $bus_id)->first();
                if ($exist_rating) {
                    // Nếu đánh giá sản phẩm đang là 5 sao nhưng người dùng chỉ muốn cho 3 sao thì 
                    // đánh giá mới từ input $stars_rated sẽ được insert vào database
                    $exist_rating->stars_rating = $stars_rated;
                    $exist_rating->update();
                } else {
                    Rating::create([
                        'user_id' => Auth::id(),
                        'bus_id' => $bus_id,
                        'stars_rating' => $stars_rated,
                    ]);
                }
                return redirect()->back()->with('status', 'Thank you for Rating this Bus');
            } else {
                return redirect()->back()->with('error', "This bus not exists");
            }
    }
}
