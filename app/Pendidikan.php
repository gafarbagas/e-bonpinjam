<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pendidikan extends Model
{
    public function terdakwa()
    {
        return $this->hasMany('App\Terdakwa');
    }
}
