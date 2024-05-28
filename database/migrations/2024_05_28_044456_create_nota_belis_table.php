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
        Schema::create('nota_belis', function (Blueprint $table) {
            $table->id();
            $table->boolean('status'); // 0 = belum dibayar, 1 = sudah dibayar
            $table->string('komplain')->nullable;
            $table->foreignId('customer_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nota_belis');
        Schema::dropIfExists('nota_beli_barang');
    }
};
