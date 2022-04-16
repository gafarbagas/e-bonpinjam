<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    protected $table = "peminjamans";

    protected $fillable = ['kode_peminjaman','nama_peminjam','nik_peminjam','masyarakat_id','tgl_peminjaman','alamat_peminjam','terdakwa_id','tgl_akhir','status_peminjaman_id','keterangan_peminjaman','foto_ktp_peminjam','tgl_konfirmasi_admin','persetujuan_admin','tgl_konfirmasi_jaksa','persetujuan_jaksa'];

    public function terdakwa()
    {
        return $this->belongsTo('App\Terdakwa');
    }
    public function bb()
    {
        return $this->belongsTo('App\Barangbukti', 'barang_bukti_id');
    }
    public function pinjambarbuk()
    {
        return $this->hasMany('App\PinjamBarbuk');
    }
    public function statuspeminjaman()
    {
        return $this->belongsTo('App\StatusPeminjaman', 'status_peminjaman_id');
    }

    public function masyarakat()
    {
        return $this->belongsTo('App\Masyarakat');
    }
}
