<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::create('absensis', function (Blueprint $table) {
        $table->id();

        // Menghubungkan absensi ke data santri
        $table->foreignId('santri_id')->constrained('santris')->onDelete('cascade');

        $table->date('tanggal'); // Tanggal absen dilakukan
        $table->string('kegiatan'); // Contoh: Shalat Berjamaah, Setoran Hafalan, Kajian Kitab
        $table->enum('status', ['Hadir', 'Sakit', 'Izin', 'Alfa']); // Status kehadiran

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absensis');
    }
};
