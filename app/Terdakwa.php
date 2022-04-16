<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Terdakwa extends Model
{
    protected $table = "terdakwas";

    protected $fillable = ['kode_terdakwa','jaksa_id','nik_terdakwa','nama_terdakwa','keluarga_id','orangtua_terdakwa','tempat_lahir','tanggal_lahir','tkp_desa','tkp_kecamatan','agama_id','alamat_terdakwa','pekerjaan_terdakwa','kewarganegaraan_id','pendidikan_id'];

    public function jaksa()
    {
        return $this->belongsTo('App\Jaksa');
    }

    public function keluarga()
    {
        return $this->belongsTo('App\Keluarga');
    }

    public function barangbukti()
    {
        return $this->hasMany('App\BarangBukti');
    }
    
    public function agama()
    {
        return $this->belongsTo('App\Agama');
    }

    public function kewarganegaraan()
    {
        return $this->belongsTo('App\Kewarganegaraan');
    }

    public function pendidikan()
    {
        return $this->belongsTo('App\Pendidikan');
    }
    public function peminjaman()
    {
        return $this->hasMany('App\Peminjaman','id','peminjaman_id');
    }
}
