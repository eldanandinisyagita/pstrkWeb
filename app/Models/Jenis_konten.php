<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jenis_konten extends Model
{
    use HasFactory;
    protected $fillable = [
        'jenis',
    ];


    public function konten()
    {
        return $this->belongsTo(Konten::class);
    }
}
