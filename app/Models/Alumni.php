<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumni extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama',
        'generasi',
        'pekerjaan',
        'deskripsi', // untuk penjelasan pekerjaan
        'kompetensi', //untuk kompetensi bidang kerja
        'foto',
        'admin_id',
    ];

    public function admin()
    {
        return $this->hasMany(User::class);
    }
}
