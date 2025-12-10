<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Galery extends Model
{
    use HasFactory;

    protected $table = 'galeries';

    protected $fillable = [
        'judul',
        'tanggal',
        'gambar',
        'deskripsi',
        'status',
        'user_id',
    ];

    // Relasi ke User (jika diperlukan)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
