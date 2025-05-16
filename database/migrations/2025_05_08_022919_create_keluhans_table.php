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
        Schema::create('createkeluhans', function (Blueprint $table) {
            $table->id();
            $table->string('keluhan');
            $table->integer('nip');
            $table->integer('nik');
            $table->string('nama_pelapor');
            $table->string('jabatan');
            $table->string('kategori');
            $table->string('teknisi');
            $table->string('notadinas');
            $table->string('satuankerja');
            $table->string('lantai');
            $table->string('rincian');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('createkeluhans');
    }
};
