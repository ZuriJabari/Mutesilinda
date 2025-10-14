<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Mail;

class ContactPage extends Component
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

    public function submit()
    {
        $this->validate();

        // Send email
        $data = [
            'name' => $this->name,
            'email' => $this->email,
            'message' => $this->message,
        ];

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
        return view('livewire.contact-page')
            ->layout('layouts.app', ['title' => 'Get in Touch - Contact Linda']);
    }
}
