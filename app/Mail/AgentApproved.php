<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AgentApproved extends Mailable
{
    use Queueable, SerializesModels;

    public $agent;
    public $password;

    public function __construct($agent, $password)
    {
        $this->agent    = $agent;
        $this->password = $password;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Account Approved - StudentStay',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'email.agentApproved',
            with: [
                'email'    => $this->agent->email,
                'password' => $this->password,
            ],
        );
    }
}
