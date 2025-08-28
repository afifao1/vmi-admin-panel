<?php

namespace App\Mail;

use App\Models\ContactRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactRequestNotification extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public ContactRequest $contact) {}

    public function build()
    {
        return $this->subject('Новая заявка №' . $this->contact->id)
            ->markdown('emails.contact_request', [
                'c' => $this->contact,
            ]);
    }
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Contact Request Notification',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'view.name',
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
