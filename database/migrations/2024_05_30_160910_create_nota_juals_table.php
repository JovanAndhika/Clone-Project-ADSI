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
        Schema::create('nota_juals', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('alamat')->nullable();
            $table->string('foto');
            $table->string('status')->default(0); //0 = belum dikonfimasi, 1 = approved, 2 = rejected
            $table->float('harga');
            $table->foreignId('customer_id')->constrained()->cascadeOnDelete();
            $table->foreignId('wirausaha_id')->nullable()->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nota_juals');
    }
};
