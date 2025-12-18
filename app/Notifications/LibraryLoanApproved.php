<?php

namespace App\Notifications;

use App\Models\LibraryLoan;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class LibraryLoanApproved extends Notification
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
            ->subject('Borrow request approved — Mutesi Library')
            ->greeting('Hello '.$notifiable->name.',')
            ->line('Your borrow request has been approved: '.$this->loan->book->title.'.')
            ->line('We’ll share pickup details shortly. If you need to coordinate timing, reply to this email.')
            ->action('View the library', url('/library'))
            ->salutation('With warmth, Mutesilinda');
    }
}
