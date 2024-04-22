<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SaleMail extends Mailable
{
    use Queueable, SerializesModels;
    public $full_name;
    public $total;
    public $code;
    public $percentage;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($full_name,$total,$code,$percentage,)
    {
        $this->full_name = $full_name;
        $this->total = $total;
        $this->code = $code;
        $this->percentage = $percentage;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Sale Mail',
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
            view: 'mails.sale',
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
