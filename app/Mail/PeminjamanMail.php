<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PeminjamanMail extends Mailable
{
    use Queueable, SerializesModels;
    public $peminjaman;

    public function __construct($peminjaman)
    {
        $this->peminjaman = $peminjaman;
    }

    public function build()
    {
        return $this->markdown('user.email.peminjaman-email')
            ->subject('Pengajuan Peminjaman E-BonPinjam');
    }
}
