<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Agenda extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'deskripsi',
        'tgl_mulai',
        'tgl_selesai',
        'tags', // ini agenda dosen atau mahasiswa atau kampus
        'lokasi',
        'penyelenggara',
        'admin_id'
    ];

    public function getFormattedTglMulaiAttribute()
    {
        return Carbon::parse($this->attributes['tgl_mulai'])->translatedFormat('d F Y');
    }

    public function admin()
    {
        return $this->belongsTo(User::class);
    }
}
