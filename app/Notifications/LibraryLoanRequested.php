<?php

namespace App\Notifications;

use App\Models\LibraryLoan;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class LibraryLoanRequested extends Notification
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
            ->subject('Borrow request received — Mutesi Library')
            ->greeting('Hello '.$notifiable->name.',')
            ->line('We’ve received your request to borrow: '.$this->loan->book->title.'.')
            ->line('You’ll receive another email once your request is approved.')
            ->action('View the library', url('/library'))
            ->salutation('With warmth, Mutesilinda');
    }
}
