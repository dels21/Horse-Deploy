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
        Schema::create('master_dicom', function (Blueprint $table) {
            $table->id("idLayananDicom");
            $table->ipAddress('alamatIp');
            $table->string('netMask',length:30);
            $table->enum('layananDicom',array('MWL', 'MPPS', 'Query', 'Send', 'Print', 'Store', 'Retrieve'));
            $table->enum('peran',array('SCU','SCP'));
            $table->string('aet',length:100);
            $table->integer('port');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('master_dicom');
    }
};
