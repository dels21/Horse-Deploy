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
        Schema::create('detail_hasil_pemeriksaan_radiologi', function (Blueprint $table) {
            $table->id("idDetailHasilPemeriksaan");
            $table->foreignId("idHasilPemeriksaan")->constrained("hasil_pemeriksaan_radiologi",'idHasilPemeriksaan')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId("kodeJenisPemeriksaan")->constrained("master_jenis_pemeriksaan",'kodeJenisPemeriksaan')->cascadeOnDelete()->cascadeOnUpdate();
            $table->text("laporan");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_hasil_pemeriksaan_radiologi');
    }
};
