<?php

namespace App\Mail;

use App\Models\Lead;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class LeadReceived extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Lead $lead) {}

    public function envelope(): Envelope
    {
        $type = $this->lead->form_type === 'callback' ? 'Обратный звонок' : 'Заявка на услугу';
        $region = $this->lead->region ? " ({$this->lead->region})" : '';

        return new Envelope(
            subject: "Новая заявка с сайта — {$type}{$region}",
            replyTo: $this->lead->email ? [$this->lead->email] : [],
        );
    }

    public function content(): Content
    {
        return new Content(view: 'emails.lead');
    }
}
