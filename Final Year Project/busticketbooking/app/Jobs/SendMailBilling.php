<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMailNotifyBilling;

class SendMailBilling implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $booking;
    protected $schedule;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($booking, $schedule)
    {
        $this->booking = $booking;
        $this->schedule = $schedule;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        foreach($this->schedule as $schedules) {
        Mail::to($this->booking->user->email)->send(new SendMailNotifyBilling($this->booking, $schedules));
        }
    }
}
