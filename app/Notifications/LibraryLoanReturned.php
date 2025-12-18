<?php

namespace App\Notifications;

use App\Models\LibraryLoan;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class LibraryLoanReturned extends Notification
{
    use Queueable;

    public function __construct(public LibraryLoan $loan)
    {
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Return confirmed — Mutesi Library')
            ->greeting('Hello '.$notifiable->name.',')
            ->line('Thank you for returning: '.$this->loan->book->title.'.')
            ->line('Whenever you’re ready, you can request your next book from the library.')
            ->action('Browse the library', url('/library'))
            ->salutation('With warmth, Mutesilinda');
    }
}
