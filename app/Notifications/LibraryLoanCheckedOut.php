<?php

namespace App\Notifications;

use App\Models\LibraryLoan;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class LibraryLoanCheckedOut extends Notification
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
        $due = $this->loan->due_at ? $this->loan->due_at->format('F j, Y') : null;

        $mail = (new MailMessage)
            ->subject('Book checked out — Mutesi Library')
            ->greeting('Hello '.$notifiable->name.',')
            ->line('Enjoy your reading: '.$this->loan->book->title.'.');

        if ($due) {
            $mail->line('Due date: '.$due.'.');
        }

        return $mail
            ->action('View the library', url('/library'))
            ->salutation('With warmth, Mutesilinda');
    }
}
