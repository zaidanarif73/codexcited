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
        Schema::create('materi_progress', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('materi_detail_id')->constrained('materi_details')->cascadeOnDelete();
            $table->unsignedTinyInteger('progress')->default(0); // 0‑100
            $table->timestamps();
            $table->unique(['user_id','materi_detail_id']);      // 1 baris per user + lesson
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('materi_progress');
    }
};
