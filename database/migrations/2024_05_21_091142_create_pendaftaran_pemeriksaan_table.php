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
        Schema::create('pendaftaran_pemeriksaan', function (Blueprint $table) {
            $table->id('nomorPendaftaran');
            $table->foreignId('idPasien')->constrained('pasien','idPasien')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('namaDokterPengirim',length:50);
            $table->string('attachment');
            $table->date('tanggalDaftar');
            $table->string('modalitas');
            $table->integer('verifikasi')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendaftaran_pemeriksaan');
    }
};
