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
        Schema::create('izin', function (Blueprint $table) {
            $table->id('izinID');
            $table->bigInteger('userID')->unsigned();
            $table->string('judul');
            $table->text('isi');
            $table->json('detail')->nullable();
            $table->string('status');
            $table->string('komentar')->nullable();
            $table->timestamps();

            $table->foreign('userID')->references('userID')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('izin');
    }
};
