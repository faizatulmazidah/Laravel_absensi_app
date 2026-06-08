<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kamar extends Model
{
    protected $guarded = [];

    // Relasi: Satu kamar bisa diisi banyak santri
    public function santris()
    {
        return $this->hasMany(Santri::class, 'kamar_id');
    }
}