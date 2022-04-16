<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BatasPinjam extends Model
{
    protected $table = 'batas_pinjams';

    protected $fillable = ['batas_waktu'];
}
