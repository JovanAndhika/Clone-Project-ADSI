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
        Schema::create('tugas', function (Blueprint $table) {
            $table->id();
            $table->string('jenis_tugas');
            // $table->unsignedBigInteger('notajual_id')->nullable(true);
            $table->unsignedBigInteger('notabeli_id')->nullable(true);
            // $table->foreign('notajual_id')->references('id')->on('nota_jual');
            $table->foreign('notabeli_id')->references('id')->on('nota_belis');
            $table->string('nama_penerima');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tugas');
    }
};
