<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    public function barangbukti()
    {
        return $this->hasMany('App\BarangBukti');
    }
}
