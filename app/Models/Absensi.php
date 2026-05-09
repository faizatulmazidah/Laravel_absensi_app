<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    protected $table = 'absensi'; // Mengarah ke tabel yang ada 11 data
    protected $primaryKey = 'pengenal'; // Sesuai kolom di HeidiSQL Anda
    public $timestamps = false;
    protected $fillable = ['nama_siswa', 'kelas', 'keterangan'];
}