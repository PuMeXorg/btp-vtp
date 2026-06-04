<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;

class LeadsDigest extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Collection $leads) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Заявки с сайта — выгрузка (' . $this->leads->count() . ' шт.)',
        );
    }

    public function content(): Content
    {
        return new Content(view: 'emails.leads-digest');
    }
}
