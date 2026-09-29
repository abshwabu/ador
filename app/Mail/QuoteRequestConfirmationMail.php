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

class QuoteRequestConfirmationMail extends Mailable
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
        $companyName = $this->settings->company_name ?? 'Adorn Trading PLC';
        $replyTo = [];
        if (!empty($this->settings->contact_email)) {
            $replyTo[] = new Address($this->settings->contact_email, $companyName);
        }

        return new Envelope(
            subject: "We received your consultation request — {$companyName}",
            replyTo: $replyTo,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.quote-request-confirmation',
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
