<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Authenticatable;

class Masyarakat extends Model implements AuthenticatableContract
{
    Use Authenticatable;
    protected $guard = 'masyarakat';
    protected $guarded = [];

    public function peminjaman()
    {
        return $this->hasMany('App\Peminjaman');
    }
}
