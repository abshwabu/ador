<?php

namespace App\Mail;

use App\Models\QuoteRequest;
use App\Models\Setting;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class QuoteRequestReplyMail extends Mailable
{
    use Queueable, SerializesModels;

    public Setting $settings;

    /**
     * Create a new message instance.
     */
    public function __construct(
        public QuoteRequest $quoteRequest,
        public string $replySubject,
        public string $replyMessage,
        public ?string $senderEmail = null,
        public ?string $senderName = null,
        ?Setting $settings = null
    ) {
        $this->settings = $settings ?? Setting::instance();
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        $replyTo = [];
        if (!empty($this->senderEmail)) {
            $replyTo[] = new Address($this->senderEmail, $this->senderName ?? 'Adorn Trading PLC');
        } elseif (!empty($this->settings->contact_email)) {
            $replyTo[] = new Address($this->settings->contact_email, $this->settings->company_name ?? 'Adorn Trading PLC');
        }

        return new Envelope(
            subject: $this->replySubject,
            replyTo: $replyTo,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.quote-request-reply',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
