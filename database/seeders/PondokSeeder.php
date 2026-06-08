<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // Ini kunci utamanya supaya DB dikenali resmi!

class PondokSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Membersihkan data lama terlebih dahulu biar tidak bentrok
        DB::table('santris')->delete();
        DB::table('kamars')->delete();

        // 2. Membuat data Kamar contoh
        DB::table('kamars')->insert([
            ['id' => 1, 'nama_kamar' => 'Kamar Al-Ikhlas', 'kapasitas' => 15],
            ['id' => 2, 'nama_kamar' => 'Kamar Al-Fatih', 'kapasitas' => 15],
        ]);

        // 3. Membuat data Santri contoh
        DB::table('santris')->insert([
            ['nis' => '10001', 'nama_santri' => 'Ahmad Fauzi', 'jenis_kelamin' => 'L', 'kamar_id' => 1],
            ['nis' => '10002', 'nama_santri' => 'Muhammad Rifqi', 'jenis_kelamin' => 'L', 'kamar_id' => 1],
            ['nis' => '20001', 'nama_santri' => 'Siti Aminah', 'jenis_kelamin' => 'P', 'kamar_id' => 2],
            ['nis' => '20002', 'nama_santri' => 'Fatimatuz Zahra', 'jenis_kelamin' => 'P', 'kamar_id' => 2],
        ]);
    }
}