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
        Schema::create('hasil_pemeriksaan_radiologi', function (Blueprint $table) {
            $table->id("idHasilPemeriksaan");
            $table->foreignId("nomorPemeriksaan")->constrained("transaksi_pemeriksaan",'nomorPemeriksaan')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId("idDokter")->constrained("dokter",'idDokter')->cascadeOnDelete()->cascadeOnUpdate();
            $table->date("tanggalLaporan");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hasil_pemeriksaan_radiologi');
    }
};
