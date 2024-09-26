<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class TicketNotificationSend extends Mailable
{
    use Queueable, SerializesModels;

    public $title;
    public $message;
    public $subject;

    /**
     * Create a new message instance.
     */
    public function __construct($title, $message, $subject)
    {
        $this->title = $title;
        $this->message = $message;
        $this->subject = $subject;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->subject,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'backend.mailview',
            with: [
                'title' => $this->title,
                'ticket_no' => $this->message->ticket_no,
                'description' => $this->message->description,
                'ticket_title' => $this->message->title
            ],
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
