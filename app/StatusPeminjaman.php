<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StatusPeminjaman extends Model
{
    protected $table = 'status_peminjamans';

    public function peminjaman()
    {
        return $this->hasMany('App\Peminjaman');
    }
}
