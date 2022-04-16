<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jaksa extends Model
{
    protected $fillable = ['nrp_jaksa', 'nama_jaksa','jabatan','pangkat','user_id'];

    public function terdakwa()
    {
        return $this->hasMany('App\Terdakwa','id','terdakwa_id');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function peminjaman()
    {
        return $this->hasManyThrough('App\Peminjaman','App\Terdakwa');
    }
}