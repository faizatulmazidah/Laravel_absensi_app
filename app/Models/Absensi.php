<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    protected $table = 'absensis'; 

    protected $guarded = [];

    // Relasi: Menegaskan bahwa santri_id di tabel absen terhubung ke id asli si santri
    public function santri()
    {
        return $this->belongsTo(Santri::class, 'santri_id', 'id');
    }
}