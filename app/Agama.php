<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Agama extends Model
{
    protected $table = "agamas";

    public function terdakwa()
    {
        return $this->hasMany('App\Terdakwa');
    }
}
