<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CodePromoMail extends Mailable
{
    use Queueable, SerializesModels;
    public $code;
    public $percentage;
    public $full_name;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($code,$percentage,$full_name)
    {
        $this->code = $code;
        $this->percentage = $percentage;
        $this->full_name = $full_name;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Partenaire Contact-Shop',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            view: 'mails.newPartner',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
