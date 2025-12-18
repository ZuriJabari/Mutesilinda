<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class ContactModal extends Component
{
    public $name = '';
    public $email = '';
    public $message = '';
    public $success = false;

    protected $rules = [
        'name' => 'required|min:2',
        'email' => 'required|email',
        'message' => 'required|min:10',
    ];

    public function resetForm(): void
    {
        $this->reset(['name', 'email', 'message', 'success']);
    }

    public function submit(): void
    {
        $this->validate();

        Mail::raw(
            "New contact form submission from {$this->name} ({$this->email}):\n\n{$this->message}",
            function ($message) {
                $message->to(config('mail.contact_email', 'linda@mutesilinda.com'))
                    ->subject('New Contact Form Submission')
                    ->replyTo($this->email, $this->name);
            }
        );

        $this->success = true;
        $this->reset(['name', 'email', 'message']);
    }

    public function render()
    {
        return view('livewire.contact-modal');
    }
}
