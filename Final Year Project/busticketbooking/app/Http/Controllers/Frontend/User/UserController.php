<?php

namespace App\Http\Controllers\Frontend\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\User\ChangePasswordRequest;
use App\Http\Requests\User\UpdateProfileRequest;
use App\Models\User;
use App\Models\Booking;
use App\Models\Schedule;
use DB;
use File;


class UserController extends Controller
{
    public function changePassword()
    {
        return view('frontend.accountUser.changePassword');
    }

    public function updatePassword(ChangePasswordRequest $request)
    {
        // Check user want change password
        $user = Auth::user();
        // Check password in DB have the same with old_password user input
        if(!(Hash::check($request['old_password'], $user->password))) {
            return redirect()->back()->with('warning','The password currently used does not matches with the provided password.');
        }       
        //Sring compare: Old password and the new one
        if(strcmp($request['old_password'], $request['new_password']) == 0){
            return redirect()->back()->with('warning','The new password cannot be the same with current password.');
        }
        //bcrypt --> password-hashing function
        $user->password = bcrypt($request['new_password']);
        DB::table('users')->where('id', $user->id)->update(['password' => $user->password]);
        return redirect('/')->with('success','Password changed successfully !');
    }

    public function profile()
    {
        $user = Auth::user();
        $show_info = User::where('id', $user->id)->first();
        return view('frontend.accountUser.profile', [
            'user'=> $user,
            'show_info' => $show_info
        ]);
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        $fullname = $request->input('full_name');
        $address = $request->input('address');
        $gender = $request->input('gender');
        $phone_number = $request->input('phone_number');
        $birthday = $request->input('birthday');

        $get_info = User::findOrFail($user->id);
        $get_info->update([
            'name' => $fullname,
            'address' => $address,
            'gender' => $gender,
            'phone_number' => $phone_number,
            'date_of_birth' => $birthday,
        ]);
        return redirect('/edit-profile')->with('status', 'Update Profile Successfully');
    }

    public function uploadAvatar(Request $request)
    {
        // Check user current
        $user = Auth::user();
        $exist_avatar = $user->avatar;
        if($request->hasFile('image'))
        {
            // Delete avatar exist
            $assetAvatar = asset('admin/upload/img/'.$exist_avatar);
            if(File::exists($assetAvatar))
            {
                File::delete($assetAvatar);
            }
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension(); //Lấy tên file bao gồm extension ví dụ: .png, .jpg
            $filename = time().'.'.$ext;
            $file->move('admin/upload/img/',$filename);
            $user->avatar = $filename;
            // Update avatar in db
            DB::table('users')->where('id', $user->id)->update(['avatar' => $user->avatar]);
        }
        return redirect()->back()->with('success','Avatar upload successfully');
    }

    public function myBooking() {
        $user = Auth::user();
        // get first record
        $booking = Booking::where('user_id', $user->id)->get();
        foreach($booking as $book)
        {
            $schedule = Schedule::where('id', $book->schedule_id)->get();
        }
        return view('frontend.accountUser.myBooking', [
            'booking'=>$booking,
            'schedule' => $schedule,
        ]);
    }

    // public function CancelBooking($id)
    // {
    //     $booking = Booking::findOrFail($id);
    //     if($booking)
    //     {
    //         $booking->delete();
    //         return redirect()->back()->with('status', 'Cancel Booking Successfully');
    //     }
    // }

}
