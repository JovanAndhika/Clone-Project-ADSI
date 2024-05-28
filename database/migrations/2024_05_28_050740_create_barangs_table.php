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
            $table->foreignId('wirausaha_id')->constrained(
                table: 'users', indexName: 'barang_wirausaha_id'
            )->cascadeOnDelete();
            $table->timestamps();
        });

        // many to many table pivot
        Schema::create('nota_beli_barang', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\NotaBeli::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(\App\Models\Barang::class)->constrained()->cascadeOnDelete();
            $table->integer('jumlah');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barangs');
    }
};
