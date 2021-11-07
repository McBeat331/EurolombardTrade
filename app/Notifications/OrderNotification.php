<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use NotificationChannels\Telegram\TelegramChannel;
use NotificationChannels\Telegram\TelegramMessage;

class OrderNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [TelegramChannel::class];
    }

    public function toTelegram($post)
    {
        $opt = $post->isOpt ? 'Да' : 'Нет';
        return TelegramMessage::create()
            ->to(config('services.telegram-bot-api.channels.order'))
            ->content("*Новый заказ*\nГород: {$post->city->name}\n\nФИО: {$post->fio}\nEmail: {$post->email}\nТелефон: {$post->phone}\n\nОПТ: {$opt}\nПродажа: {$post->rate_sale}\nПокупка: {$post->rate_buy}\nОбмен: {$post->price_sale}{$post->currency_buy} => {$post->price_buy}{$post->currency_sale}");
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
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
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
}
