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
        Schema::create('jawaban_users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sesi_jurnal_id')->nullable();
            $table->foreignId('user_id')->nullable();
            $table->text('pertanyaan_label');
            $table->text('jawaban_user')->nullable();
            $table->unsignedBigInteger('pertanyaan_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jawaban_users');
    }
};
