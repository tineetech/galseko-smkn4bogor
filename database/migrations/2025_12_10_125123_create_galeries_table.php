<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGaleriesTable extends Migration
{
    public function up()
    {
        Schema::create('galeries', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->date('tanggal');
            $table->string('gambar'); // path file
            $table->text('deskripsi');
            $table->enum('status', ['aktif', 'menunggu', 'ditolak', 'draft'])->default('menunggu');
            $table->unsignedBigInteger('user_id')->nullable(); // opsional, jika ingin tahu siapa yang upload
            $table->timestamps();

            // Jika pakai user tabel
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('galeries');
    }
}
