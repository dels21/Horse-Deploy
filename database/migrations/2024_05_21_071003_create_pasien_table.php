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
        Schema::create('pasien', function (Blueprint $table) {
            $table->id('idPasien');
            $table->foreignId("idUser") -> constrained('users','id')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('tempatLahir',length: 100);
            $table->date('tanggalLahir');
            $table->bigInteger('noIdentitas');
            $table->string('tipeIdentitas', length: 10);
            $table->enum('jenisKelamin',array('laki','perempuan'));
            $table->string('pekerjaan',length: 30);
            $table->string('alamat',length: 100);
            $table->string('kota',length: 30);
            $table->string('nomorRumah',length: 10);
            $table->string('nomorHp',length: 15);
            $table->string('namaKontakDarurat',length: 100);
            $table->string('nomorDarurat',length: 15);
            $table->string('kewarganegaraan',length: 30);
            $table->string('statusPerkawinan',length: 20);
            $table->date('tanggalDaftar');
            $table->text('alergi');
            $table->enum('golonganDarah',array('A+', 'B+', 'AB+', 'O+', 'A-', 'B-', 'AB-', 'O-'));
            $table->integer('tinggiBadan');
            $table->integer('beratBadan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pasien');
    }
};
