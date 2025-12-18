<?php

namespace App\Notifications;

use App\Models\LibraryHold;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class LibraryHoldAvailable extends Notification
{
    use Queueable;

    public function __construct(public LibraryHold $hold)
    {
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Your waitlisted book is available — Mutesi Library')
            ->greeting('Hello '.$notifiable->name.',')
            ->line('Good news — this book is now available: '.$this->hold->book->title.'.')
            ->line('Please visit the library page and request to borrow it.')
            ->action('Request the book', url('/library'))
            ->salutation('With warmth, Mutesilinda');
    }
}
