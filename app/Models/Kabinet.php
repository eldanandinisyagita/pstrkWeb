<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kabinet extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama',
        'jabatan',
        'departemen',
        'tahun',
        'foto',
        'hima_id'
    ];
    public function hima()
    {
        return $this->belongsTo(Hima::class);
    }
}
