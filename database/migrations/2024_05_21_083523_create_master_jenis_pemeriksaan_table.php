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
        Schema::create('master_jenis_pemeriksaan', function (Blueprint $table) {
            $table->id('kodeJenisPemeriksaan');
            $table->foreignId('kodeModalitas')->constrained('master_modalitas','kodeModalitas')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('namaJenisPemeriksaan',length:100);
            $table->enum('kelompokJenisPemeriksaan',array('CT', 'MR', 'XP-R', 'XP-F', 'XP-WH', 'USG'));
            $table->string('pemakaianKontras',length:15);
            $table->double('harga');
            $table->bigInteger('lamaPemeriksaan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('master_jenis_pemeriksaan');
    }
};
