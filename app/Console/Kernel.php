<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Models\Agreement;
use App\Jobs\AgreementJob;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        //قولنامه
        $schedule->command('queue:work --queue=AgreementJob --stop-when-empty')->dailyAt('22:21')
        ->before(function(){
            //همه ی قولنامه ها دریافت می شوند
            $agreement_date=Agreement::all();
            foreach ($agreement_date as $agreement_date) {
                $v = verta();
                //تاریخ پایان قولنامه
                $v3 = verta($agreement_date->end_date);
                //تاریخ حال
                $v2 = verta($v->year.'/'.$v->month.'/'.$v->day);
                //سی روز مانده تا پایان قولنامه
                
                if($v2->diffDays($v3)===40)
                {
                    $day1=40;
                    //اجرای کار زمان بندی شده و ارسال تاریخ پایان و تعداد روز
                    AgreementJob::dispatch($agreement_date,$day1)->onQueue('AgreementJob');
                }
                //پانزده روز مانده تا پایان قولنامه
                if($v2->diffDays($v3)===15){
               
                    $day2=15;
                    //اجرای کار زمان بندی شده و ارسال تاریخ پایان و تعداد روز
                    AgreementJob::dispatch($agreement_date,$day2)->onQueue('AgreementJob');
                }

            };
        });

        //تولد
        $schedule->command('queue:work --queue=AgreementBirthdayJob --stop-when-empty')->dailyAt('22:22')
            ->before(function(){
                $agreementBirthday=Agreement::all();
                    foreach ($agreementBirthday as $agreement) {
                    $v = verta();
                    // تاریخ تولد مشتری
                    $agrc = substr($agreement->customer_birth, 9);
                    $v3 = verta($agrc);
                    // تاریخ تولد مشتری
                    $agro = substr($agreement->owner_birth, 9);
                    $v4 = verta($agro);
                    //تاریخ امروز
                    $v2 = verta($v->month.'/'.$v->day);
                    if($v2->diffDays($v3)===0)
                    {
                        $type="birthdaycustomer";
                        AgreementJob::dispatch($agreement,$type)->onQueue('AgreementBirthdayJob');
                    }
                    if($v2->diffDays($v4)===0)
                    {
                        $type="birthdayowner";
                        AgreementJob::dispatch($agreement,$type)->onQueue('AgreementBirthdayJob');
                    }
                };
    });
}

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}