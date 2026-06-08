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
    Schema::create('santris', function (Blueprint $table) {
        $table->id();
        $table->string('nis')->unique(); // Nomor Induk Santri
        $table->string('nama_santri');
        $table->enum('jenis_kelamin', ['L', 'P']); // Laki-laki / Perempuan
        
        // Ini untuk menghubungkan Santri ke Kamar mereka (Foreign Key)
        $table->foreignId('kamar_id')->constrained('kamars')->onDelete('cascade');
        
        $table->timestamps();
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('santris');
    }
};
