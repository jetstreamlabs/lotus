<?php

namespace App\Domain\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ConfirmUserEmail extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $url  = route('register.activate', ['activationToken' => $notifiable->activation_token]);
        $name = $notifiable->name;

        return (new MailMessage)
            ->subject('Please Confirm Your Email Address')
            ->markdown('mail.confirm', ['url' => $url, 'name' => $name]);
    }
}
