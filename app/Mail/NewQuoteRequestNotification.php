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

class NewQuoteRequestNotification extends Mailable
{
    use Queueable, SerializesModels;

    public Setting $settings;

    /**
     * Create a new message instance.
     */
    public function __construct(
        public QuoteRequest $quoteRequest,
        ?Setting $settings = null
    ) {
        $this->settings = $settings ?? Setting::instance();
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        $subject = 'New Consultation Request from ' . $this->quoteRequest->full_name;
        if (!empty($this->quoteRequest->company)) {
            $subject .= ' (' . $this->quoteRequest->company . ')';
        }

        $replyTo = [];
        if (!empty($this->quoteRequest->email)) {
            $replyTo[] = new Address($this->quoteRequest->email, $this->quoteRequest->full_name);
        }

        return new Envelope(
            subject: $subject,
            replyTo: $replyTo,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.new-quote-request',
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
