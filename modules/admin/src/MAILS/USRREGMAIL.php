<?php

namespace ARJUN\ADMIN\MAILS;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class USRREGMAIL extends Mailable {

    protected $package;

    use Queueable,
        SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct() {
        $this->package = 'admin';
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build() {
        return $this->markdown($this->package . '::emails.users.registration');
    }

}
