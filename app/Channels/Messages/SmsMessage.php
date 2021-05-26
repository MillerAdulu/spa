<?php

namespace App\Channels\Messages;

class SmsMessage
{
    /**
     * @var string
     */
    public $notificationmessage;

    public function notificationmessage($notificationmessage)
    {
        $this->notificationmessage = $notificationmessage;

        return $this;
    }
}