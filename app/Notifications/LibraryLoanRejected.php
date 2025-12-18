<?php

namespace App\Notifications;

use App\Models\LibraryLoan;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class LibraryLoanRejected extends Notification
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
            ->subject('Borrow request update — Mutesi Library')
            ->greeting('Hello '.$notifiable->name.',')
            ->line('We’re unable to approve your borrow request for: '.$this->loan->book->title.'.')
            ->line('You can request another book anytime from the library.')
            ->action('Browse the library', url('/library'))
            ->salutation('With warmth, Mutesilinda');
    }
}
