<?php

namespace App\Channels;

use Illuminate\Notifications\Notification;
use Overtrue\EasySms\EasySms;
use Overtrue\EasySms\Message;

class SmsChannel
{
    /**
     * 发送给定通知
     *
     * @param  mixed  $notifiable
     * @param  \Illuminate\Notifications\Notification  $notification
     * @return void
     */
    public function send($notifiable, Notification $notification)
    {
        if (!$to = $notifiable->routeNotificationFor('sms')) {
            return;
        }

        $message = $notification->toSms($notifiable);

        if (!($message instanceof Message)) {
            return;
        }

        $easySms = new EasySms(config('sms.easysms'));

        $response = $easySms->send($to, $message);
        
        return $response;
    }
}
