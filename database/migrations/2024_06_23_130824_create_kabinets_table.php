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
        Schema::create('kabinets', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('jabatan');
            $table->string('departemen');
            $table->year('tahun');
            $table->string('foto');
            $table->timestamps();
            $table->unsignedBigInteger('hima_id');   // foreign key dari tabel admin

            $table->foreign('hima_id')->references('id')->on('himas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kabinets');
    }
};
