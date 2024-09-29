<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Jobs\birthday;
use Illuminate\Http\Request;
use App\Models\User;
use App\Notifications\AgreementsSMS;
use Illuminate\Support\Facades\Notification;
use App\Notifications\OtpSms;
use App\Models\Agreement;
use App\Jobs\AgreementJob;
use App\Jobs\BirthdaySms;
use Verta;


class AuthController extends Controller
{

    // public function login(Request $request){
    //     if ($request->method() == 'GET') {
    //         return view('auth.login');
    //     }
      


public function smsagreement(){ 
    
    $agreementBirthday=Agreement::all();
    foreach ($agreementBirthday as $agreement) {
    $v = verta();
    // تاریخ تولد
    $agr = substr($agreement->end_date, 9);
    $v3 = verta($agr);
    //تاریخ امروز
    $v2 = verta($v->month.'/'.$v->day);
    if($v2->diffDays($v3)===0)
    {echo $agreement->customer;
        $type="birthday";
        AgreementJob::dispatch($agreement,$type)->onQueue('AgreementBirthdayJob');
    }};
    
    }
    public function sms(){ 
    
        $v=Agreement::all();
        foreach ($v as $value) {
        $v = verta();
        $v3 = verta($value->end_date);
        $v2 = verta($v->year.'/'.$v->month.'/'.$v->day);
        // dd($v2->diffDays($v3));
       
        // AgreementJob::dispatchNow($value,30)->onQueue('AgreementJob');

        // dd($value);

        if($v2->diffDays($v3)===30)
        {
            $day1=30;
            AgreementJob::dispatchNow($value,$day1)->onQueue('AgreementJob');
        }
        if($v2->diffDays($v3)===15)
        {
            $day2=15;
            AgreementJob::dispatchNow($value,$day2)->onQueue('AgreementJob');
        }
        };
        }
   
    // dd($v);
   
    
    // $user=User::find(1);
    // Notification::send($user,new AgreementsSMS("تبریک تولد"));
    // birthday::dispatch()->onQueue('birthdayjob');
    
        // $user=User::find(1);
        // Notification::send($user,new OtpSms("12345"));
        // Notification::send($user,new AgreementsSMS("تبریک تولد"));

}

    
 