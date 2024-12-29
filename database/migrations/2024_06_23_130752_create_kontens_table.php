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
        Schema::create('kontens', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->longText('deskripsi');
            $table->string('tags');
            $table->date('tgl_publish');
            $table->string('status');
            $table->string('lampiran');
            $table->timestamps();
            $table->unsignedBigInteger('admin_id');   // foreign key dari tabel admin
            $table->unsignedBigInteger('jenis_id');

            $table->foreign('admin_id')->references('id')->on('users');
            $table->foreign('jenis_id')->references('id')->on('jenis_kontens');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kontens');
    }
};
