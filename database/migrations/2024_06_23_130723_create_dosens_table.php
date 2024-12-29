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
        Schema::create('dosens', function (Blueprint $table) {
            $table->id();
            $table->string('nip');
            $table->string('nama');
            $table->string('email');
            $table->string('foto');
            $table->string('kompetensi');
            $table->string('matkul');
            $table->string('status');
            $table->string('lampiran'); // untuk link selain pddikti
            $table->string('pddikti'); // untuk link pddikti
            $table->timestamps();
            $table->unsignedBigInteger('admin_id');   // foreign key dari tabel admin

            $table->foreign('admin_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dosens');
    }
};
