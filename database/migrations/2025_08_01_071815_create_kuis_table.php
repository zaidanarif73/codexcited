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
        Schema::create('kuis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('materi_id'); // foreign key ke tabel materi
            $table->text('question');
            $table->json('options');       // Menyimpan array pilihan dalam bentuk JSON
            $table->integer('correct');    // Indeks pilihan yang benar
            $table->text('explanation');   // Penjelasan jawaban
            $table->timestamps();

            // Relasi ke tabel materi
            $table->foreign('materi_id')->references('id')->on('materis')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kuis');
    }
};