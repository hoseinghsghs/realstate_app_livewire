<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\User;
use Illuminate\Support\Facades\Notification;
use App\Notifications\AgreementsSMS;

class AgreementJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $agreement;
    public $day;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($val,$day)
    {
       
        $this->agreement=$val;
        $this->day=$day;
        
    }
    

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Notification::send($this->agreement,new AgreementsSMS($this->day));
    }
}