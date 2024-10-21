<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Reactivos;


class ReactivosAlerta extends Mailable
{
    use Queueable, SerializesModels;

    public $reactivo;
    public $mensaje;

    /**
     * Create a new message instance.
     */
    public function __construct(Reactivos $reactivo, $mensaje)
    {
        //
        $this->reactivo = $reactivo;
        $this->mensaje = $mensaje;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: 'hola@mauticolombia.pro',
            subject: 'Alerta de Disponibildad de Reactivos',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.reactivos-alerta',
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
