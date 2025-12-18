<?php

namespace App\Notifications;

use App\Models\LibraryHold;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class LibraryHoldCreated extends Notification
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
            ->subject('You’re on the waitlist — Mutesi Library')
            ->greeting('Hello '.$notifiable->name.',')
            ->line('This book is currently on loan, and you’ve been added to the waitlist: '.$this->hold->book->title.'.')
            ->line('We’ll notify you when it becomes available.')
            ->action('View the library', url('/library'))
            ->salutation('With warmth, Mutesilinda');
    }
}
