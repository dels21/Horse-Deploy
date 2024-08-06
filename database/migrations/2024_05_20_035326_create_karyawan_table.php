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
        Schema::create("karyawan", function (Blueprint $table) {
            $table-> id("idKaryawan");
            $table-> foreignId("idUser") -> constrained('users','id')->cascadeOnDelete()->cascadeOnUpdate();
            $table-> bigInteger('idKtp');
            $table-> enum('jenisKelamin',array('laki','perempuan'));
            $table-> date('tanggalLahir');
            $table-> text('alamat');
            $table-> string('kota',length: 30);
            $table-> string('nomorHp',length: 15);
            $table-> string('nomorTelpRumah',length: 10);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("karyawan");
    }
};
