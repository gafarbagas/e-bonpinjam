<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AdminKonfirmasiPeminjamanMail extends Mailable
{
    use Queueable, SerializesModels;
    public $peminjamanBaru;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($peminjamanBaru)
    {
        $this->peminjamanBaru = $peminjamanBaru;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('admin.pages.email.konfirmasi-email')
            ->subject('Perubahan Status Peminjaman');
    }
}
