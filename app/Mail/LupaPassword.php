<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class LupaPassword extends Mailable
{
    use Queueable, SerializesModels;
    public $email, $token, $namaMasyarakat;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email, $token, $namaMasyarakat)
    {
        $this->email = $email;
        $this->token = $token;
        $this->namaMasyarakat = $namaMasyarakat;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('user.email.lupapassword')
            ->subject('Lupa Password E-BonPinjam');
    }
}
