<?php 

namespace App\Channels;

use Illuminate\Notifications\Notification;
use SoapClient;
// use Ghasedak\GhasedakApi;


class SmsChannel {

    public function send($notifiable, Notification $notification){
        
        
        
        if($notification->toSms($notifiable)=="birthdaycustomer"){
            $client = new SoapClient("http://ippanel.com/class/sms/wsdlservice/server.php?wsdl");
            $user = "09133184182"; 
            $pass = "faraz1285854233"; 
            $fromNum = "+983000505"; 
            $toNum = array($notifiable->customer_tel); 
            $pattern_code = "i2tzzohukwm5u2y"; 
            $input_data = array("name" => $notifiable->customer_name); 
            echo $client->sendPatternSms($fromNum,$toNum,$user,$pass,$pattern_code,$input_data); 
        }
        if($notification->toSms($notifiable)=="birthdayowner"){
            $client = new SoapClient("http://ippanel.com/class/sms/wsdlservice/server.php?wsdl");
            $user = "09133184182"; 
            $pass = "faraz1285854233"; 
            $fromNum = "+983000505"; 
            $toNum = array($notifiable->owner_tel); 
            $pattern_code = "i2tzzohukwm5u2y"; 
            $input_data = array("name" => $notifiable->owner_name); 
            echo $client->sendPatternSms($fromNum,$toNum,$user,$pass,$pattern_code,$input_data); 
        }
        if($notification->toSms($notifiable)==15 or $notification->toSms($notifiable)==40) {
            $day=$notification->toSms($notifiable);
            $client = new SoapClient("http://ippanel.com/class/sms/wsdlservice/server.php?wsdl");
            $user = "09133184182"; 
            $pass = "faraz1285854233"; 
            $fromNum = "+983000505"; 
            $toNum = array($notifiable->customer_tel); 
            $pattern_code = "58rhnc1zstauh6b"; 
            $input_data = array("name" => $notifiable->customer_name,"number"=>$notifiable->id,"date"=> $day); 
            echo $client->sendPatternSms($fromNum,$toNum,$user,$pass,$pattern_code,$input_data);   
        }
    }
}







//////////////////////////////////////////////////=============================
        
     
     
        // $api = new GhasedakApi(env('GHASEDAKAPI_KEY'));
        // $api->Verify(
        // "$receptor",
        // 1,  
        // "signal",             
        // $notification->toSms($notifiable),  
        // ); 
?>