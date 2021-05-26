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
    public $message;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
        $this->message = "Hi {$user->first_name}, you're now set to trade";
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'broadcast', SmsNotificationChannel::class];
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
                    ->line('Your trading account is now active.')
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
            //
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

        // return (new BroadcastMessage)
        // ->message("Hi {$this->user->first_name}, you're now set to trade");
        return new BroadcastMessage([
            'message' => $this->message,
        ]);
    }

    /**
    * Get the sms representation of the notification.
    * @param $notifiable
    * @return TwilioSmsMessage
    */
    public function toSms($notifiable)
    {

        return (new SmsMessage)
        ->notificationmessage("Hi {$this->user->first_name}, you're now set to trade");

        // return new SmsMessage([
        //     'notificationmessage' => $this->message,
        // ]);
    }

    public function broadcastType()
    {
        return 'broadcast.message';
    }
}
