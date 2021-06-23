<?php

namespace App\Notifications;

use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\User;
use App\Channels\SmsNotificationChannel;
use App\Channels\Messages\SmsMessage;

class TradingAccountActivated extends Notification implements ShouldQueue
{
    use Queueable;

     /**
     * The user instance.
     *
     * @var \App\Models\User
     */
    public $user;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user; //how to pass user information into email, sms & broadcast without making public or defining it. e.g. $user->first_name
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable) // use vonage or custom channel with TwilioSms
    {
    return ['mail', 'broadcast', 'database'/*, SmsNotificationChannel::class*/];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line("Hi {$this->user->first_name}, your trading account is now active.")
                    ->action('Connect Your Brokerage Account', url('/'))
                    ->line('Happy Investing!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'message' => "Hi {$this->user->first_name}, you're now set to trade"
        ];
    }

    /**
    * Get the broadcastable representation of the notification.
    *
    * @param  mixed  $notifiable
    * @return BroadcastMessage
    */
    public function toBroadcast($notifiable)
    {

        // return (new BroadcastMessage) //both ways correct
        // ->message("Hi, you're now set to trade");
        return new BroadcastMessage([
            'message' => "Hi {$this->user->first_name}, you're now set to trade"
        ]);
    }

    /**
    * Get the sms representation of the notification.
    * @param $notifiable
    * @return TwilioSmsMessage
    */
    public function toSms($notifiable)
    {

        // return (new SmsMessage) //both ways work
        // ->notificationmessage("Hi {$this->user->first_name}, you're now set to trade");

        // return new SmsMessage([
        //     'notificationmessage' => "Hi {$this->user->first_name}, you're now set to trade"
        // ]);
    }

    public function broadcastType()
    {
        return 'broadcast.message';
    }
}
