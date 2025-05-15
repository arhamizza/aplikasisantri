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
        Schema::create('pakets', function (Blueprint $table) {
            $table->increments('id');
            $table->string("nama_paket",100);
            $table->date("tanggal_diterima");
            $table->unsignedInteger('kategori_paket');
            $table->foreign('kategori_paket')->references('id')->on('kategori_pakets');
            $table->string('penerima_paket');
            $table->foreign('penerima_paket')->references('nis')->on('santris');
            $table->unsignedBigInteger('asrama');
            $table->foreign('asrama')->references('id')->on('asramas');
            $table->string("pengirim_paket",100);
            $table->string("isi_paket_yang_disita",200);
            $table->enum('status_paket', ['diambil', 'belum_diambil']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pakets');
    }
};
