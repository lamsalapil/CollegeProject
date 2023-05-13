<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contract;
use App\Models\User;
use App\Jobs\SendMailContact;

class ContactController extends Controller
{
    public function index()
    {
        return view('frontend.contact');
    }

    public function getContractUser(Request $request)
    {
        $contact = Contract::create([
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'messages' => $request->messages,
        ]);
        $admin_receiver = User::where('role_id', User::ADMIN)->get();
        SendMailContact::dispatch($admin_receiver, $contact)->delay(now());
        return redirect()->back()->with('status', 'Thank you. Your contact sent to us!!'); 
    }
}
