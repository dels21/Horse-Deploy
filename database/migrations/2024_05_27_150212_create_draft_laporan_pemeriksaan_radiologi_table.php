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
        Schema::create('draft_laporan_pemeriksaan_radiologi', function (Blueprint $table) {
            $table->id("idDraftlaporan");
            $table->foreignId("idKaryawan")->constrained("karyawan",'idKaryawan')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId("kodeJenisPemeriksaan")->constrained("master_jenis_pemeriksaan",'kodeJenisPemeriksaan')->cascadeOnDelete()->cascadeOnUpdate();
            $table->text("laporanNormal");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('draft_laporan_pemeriksaan_radiologi');
    }
};
