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
            $table->string('nama');  // Item name
            $table->text('deskripsi');  // Item description
            $table->foreignId('jenis_barang_id');  // Delete barang when jenis_barang is deleted
            $table->foreignId('merk_barang_id');  // Delete barang when jenis_barang is deleted
            $table->integer('harga_modal'); // Item price
            $table->integer('harga_jual'); // Item price
            $table->json('gambar'); // Store multiple images as an array (in JSON)
            $table->json('opsi_barang')->nullable(); // Store multiple images as an array (in JSON)
            $table->string('stok'); // Item price
            $table->string('berat'); // Item price
            $table->timestamps();
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
