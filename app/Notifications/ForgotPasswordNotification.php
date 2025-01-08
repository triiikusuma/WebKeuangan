<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\ResetPassword as ResetPasswordNotification;
use Illuminate\Notifications\Messages\MailMessage;

class ForgotPasswordNotification extends ResetPasswordNotification
{
    /**
     * Get the notification's mail representation.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->greeting('Hello ' . $notifiable->name . ',')  // Custom greeting with user's name
            ->line('We have received a request to reset your password.')
            ->action('Reset Password', url(route('password.reset', $this->token, false)))  // Reset link
            ->line('If you did not request a password reset, please ignore this email.')
            ->line('Thank you for using our application!');  // Customize outro text
    }
}
