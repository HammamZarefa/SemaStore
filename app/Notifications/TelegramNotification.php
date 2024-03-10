<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Config;
use NotificationChannels\Telegram\TelegramMessage;
use NotificationChannels\Telegram\TelegramChannel;

class TelegramNotification extends Notification
{
    use Queueable;

    protected $data;
    protected $url;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($url,$data)
    {
        $this->data = $data;
        $this->url = $url;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [TelegramChannel::class];
    }

    public function toTelegram($notifiable)
    {
        return TelegramMessage::create()
            ->to(config('services.telegram-bot-api.chat_id'))
            ->content("*" . "🔥 New order! 🔥"
                . "*\n" . "Product:  " . "*" . @$this->data['category_name']
                . "*\n" . "Service:  " . "*" . @$this->data['service_name']
                . "*\n" . "User:  " . "*" . @$this->data['username']
                . "*\n" . "quantity:  " . "*" . @$this->data['quantity']
                . "*"
            )
            ->button('View Details', @$this->url);

    }
}
