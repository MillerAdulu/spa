<?php

namespace App\Channels;

use Illuminate\Notifications\Notification;
use App\Http\Controllers\SmsController;
use Propaganistas\LaravelPhone\PhoneNumber;

class SmsNotificationChannel
{
        /**
     * @param $notifiable
     * @param Notification $notification
     * @throws \Twilio\Exceptions\TwilioException
     */
    public function send($notifiable, Notification $notification)
    {
        $message = $notification->toSms($notifiable);
        $phoneNumber = $notifiable->routeNotificationFor('Sms');
        
        //format phone number for Twilio service
        //$phoneNumber = PhoneNumber::make($phoneNumber, 'NG')->formatE164();
        
        $smsnotification = new SmsController;
        $smsnotification->sendSms($phoneNumber, $message->notificationmessage);

    }
}
