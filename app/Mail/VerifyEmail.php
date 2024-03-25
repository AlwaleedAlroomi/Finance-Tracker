<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class VerifyEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(private $username)
    {
        //
    }

    /**
     * Get the message envelope.
     * Envelope – Returns the Illuminate\Mail\Mailables\Envelope object,
     * which defines the subject and the recipients.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Verify Your Email',
        );
    }

    /**
     * Get the message content definition.
     * Content –  Returns the Illuminate\Mail\Mailables\Content object,
     * which defines the Blade template used to generate message content.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.verify',
            with: ['name' => $this->username],
        );
    }

    /**
     * Get the attachments for the message.
     * Attachments – Returns an array of attachments.
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
