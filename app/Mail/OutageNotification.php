<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class OutageNotification extends Mailable
{
    use Queueable, SerializesModels;

    
    protected $email_data;
    protected $to_email;
    protected $path;

    public function __construct($email_data, $to, $path)
    {
        $this->email_data   = $email_data;
        $this->to_email     = $to;
        $this->path         = $path;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->email_data->title,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        Log::info("Sending Email to view [ ::: mail-templates.outages :::: ]");
        return new Content(
            html: 'mail-templates.outages',
            with: [
                'to' => $this->to_email,
                'data' => $this->email_data,
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
        return [
            Attachment::fromPath(storage_path("app/public/" .$this->path ."/" .$this->email_data->attachments))
                ->as('Teste.pdf')
        ];
    }
}
