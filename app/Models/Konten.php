<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Konten extends Model
{
    use HasFactory;
    protected $fillable = [
        'judul',
        'deskripsi',
        'tgl_publish',
        'tags',
        'status',
        'lampiran',
        'admin_id',
        'jenis_id',
    ];

    public function admin()
    {
        return $this->belongsTo(User::class);
    }
    public function jenis()
    {
        return $this->belongsTo(Jenis_konten::class);
    }

    public function getFormattedTglPublishAttribute()
    {
        return Carbon::parse($this->attributes['tgl_publish'])->translatedFormat('d F Y');
    }
}
