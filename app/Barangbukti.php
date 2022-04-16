<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Barangbukti extends Model
{
    public $table = "barang_buktis";

    protected $fillable = ['terdakwa_id','status_id','kode_barangbukti','nama_barangbukti'];

    public function terdakwa()
    {
        return $this->belongsTo('App\Terdakwa');
    }

    public function status()
    {
        return $this->belongsTo('App\Status');
    }

    public function peminjaman()
    {
        return $this->hasMany('App\Peminjaman');
    }

    public function bb()
    {
        return $this->hasMany('App\Pinjambarbuk');
    }
}
