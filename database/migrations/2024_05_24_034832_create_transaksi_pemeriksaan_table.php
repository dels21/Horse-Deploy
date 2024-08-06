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
        Schema::create('transaksi_pemeriksaan', function (Blueprint $table) {
            $table->id("nomorPemeriksaan");
            $table->foreignId("nomorPendaftaran")->constrained("pendaftaran_pemeriksaan",'nomorPendaftaran')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId("idKaryawanRadiografer")->constrained("karyawan",'idKaryawan')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId("idKaryawanDokterRadiologi")->constrained("dokter",'idDokter')->cascadeOnDelete()->cascadeOnUpdate();
            $table->date("tanggalPemeriksaan")->nullable();
            $table->text("keterangan")->nullable();
            $table->text("diagnosis")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi_pemeriksaan');
    }
};
