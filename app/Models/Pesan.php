<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesan extends Model
{
    use HasFactory;
    protected $fillable = [
        'email',
        'isi_pesan',
        'balasan',
        'admin_id'
    ];

    public function admin()
    {
        return $this->belongsTo(User::class);
    }
}
