<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PinjamBarbuk extends Model
{
    protected $guarded = ['id'];
    public function peminjaman()
    {
        return $this->belongsTo('App\peminjaman');
    }

    public function bb()
    {
        return $this->belongsTo('App\Barangbukti', 'barang_bukti_id');
    }
}
