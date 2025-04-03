<?php

namespace App\Lib;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailerUtils extends Mailable
{
	use Queueable, SerializesModels;

    private $isipesan;

	public function __construct($isipesan)
    {
        $this->isipesan = $isipesan;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('sistemnotifikasiapp@gmail.com')
            ->subject($this->subject)
            ->view('mail.registrasi');
    }
}
