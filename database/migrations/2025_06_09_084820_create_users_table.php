<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username', 25)->unique();
            $table->string('password')->nullable();
            $table->string('email', 50)->unique();
            $table->string('nama_depan', 50)->nullable();
            $table->string('nama_belakang', 50)->nullable();
            $table->string('status', 1)->default(1);
            $table->integer('auth_attemp')->default(0);
            $table->string('role_id');
            $table->timestamp('last_login')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
