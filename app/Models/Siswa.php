<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    // Hubungkan ke tabel yang ada datanya (11 baris di gambar)
    protected $table = 'absensi'; 

    // Sesuaikan primary key jika namanya bukan 'id' (di gambar sebelumnya: 'pengenal')
    protected $primaryKey = 'pengenal'; 

    protected $fillable = ['nama_siswa', 'kelas', 'keterangan'];
}