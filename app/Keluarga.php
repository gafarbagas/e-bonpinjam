<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Keluarga extends Model
{
    protected $table = "keluargas";

    public function terdakwa()
    {
        return $this->hasMany('App\Terdakwa');
    }
}
