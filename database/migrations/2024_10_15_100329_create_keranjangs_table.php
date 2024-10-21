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
        Schema::create('keranjangs', function (Blueprint $table) {
            $table->id();  // Primary key
            $table->foreignId('barang_id'); // Foreign key for barangs
            $table->foreignId('user_id'); // Foreign key for users
            $table->json('opsi_barang');  // Storing array as JSON
            $table->integer('quantity');
            $table->integer('total_harga');  // Decimal for storing total price
            $table->timestamps();  // For created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('keranjangs');
    }
};
