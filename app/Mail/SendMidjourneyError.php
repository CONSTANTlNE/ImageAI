<?php

namespace App\Mail;

use App\Models\Midjourney;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendMidjourneyError extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $user;
    public $midjourney;
    public $apiresponse;


    public function __construct(User $user,Midjourney $task,$apiresponse)
    {
        $this->user = $user;
        $this->midjourney = $task;
        $this->apiresponse=$apiresponse;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'ONIX - Midjourney Api Error',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.midjourney-error',
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
