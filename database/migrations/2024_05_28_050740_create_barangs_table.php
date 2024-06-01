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
        Schema::create('barangs', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->integer('harga')->default(0);
            $table->integer('stock')->default(0);
            $table->foreignId('wirausaha_id')->constrained()->cascadeOnDelete();
            $table->foreignId('jenis_barang_id')->constrained()->cascadeOnDelete();
            $table->string('foto');
            $table->text('detail')->nullable();
            $table->timestamps();
        });

        // many to many table pivot
        Schema::create('barang_nota_beli', function (Blueprint $table) {
            $table->id();
            $table->foreignId('barang_id')->constrained()->cascadeOnDelete();
            $table->foreignId('nota_beli_id')->constrained()->cascadeOnDelete();
            $table->integer('jumlah');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barangs');
        Schema::dropIfExists('barang_notabeli');
    }
};
