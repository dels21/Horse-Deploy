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
        Schema::create('detail_pemeriksaan', function (Blueprint $table) {
            $table->id("idDetailPemeriksaan");
            $table->foreignId("nomorPemeriksaan")->constrained("transaksi_pemeriksaan",'nomorPemeriksaan')->cascadeOnDelete()->cascadeOnUpdate();
            $table->time("jamMulaiPemeriksaanAlat")->nullable();
            $table->time("jamSelesaiPemeriksaanAlat")->nullable();
            $table->string("ruangan",length:20);
            $table->text("keterangan")->nullable();
            $table->enum("statusKetersediaan", ["approve","reject"]);
            $table->enum("status", array("Dalam antrian", "Ruang Tunggu", "Pemeriksaan", "Menunggu Hasil", "Hasil sudah siap"))->default("Dalam antrian");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_pemeriksaan');
    }
};
