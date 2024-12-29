<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kurikulum extends Model
{
    use HasFactory;
    protected $fillable = [
        'kode_mk',
        'nama_mk',
        'smstr',
        'sks_teori',
        'jam_teori',
        'sks_prak',
        'jam_prak',

    ];
}
