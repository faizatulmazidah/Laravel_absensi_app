<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Santri extends Model
{
    protected $guarded = []; // Mengizinkan semua kolom diisi

    // Relasi: Setiap santri punya satu kamar
    public function kamar()
    {
        return $this->belongsTo(Kamar::class, 'kamar_id');
    }
}