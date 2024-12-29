<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hima extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama',
        'sejarah',
        'visi',
        'misi',
        'deskripsi',
        'foto', // untuk poto
        'admin_id'
    ];
    public function admin()
    {
        return $this->belongsTo(User::class);
    }
    public function kabinet()
    {
        return $this->hasMany(Hima::class);
    }
}
