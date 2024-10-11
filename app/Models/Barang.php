<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama',         // Item name
        'deskripsi',    // Item description
        'jenis_barang_id', // Foreign key to jenis barang
        'merk_barang_id', // Foreign key to merk barang
        'harga_modal',        // Item price
        'harga_jual',        // Item price
        'gambar',       // Array of image paths
        'opsi_barang',       // Array
        'stok',       // Array
        'berat',     
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'gambar' => 'array', // Cast the 'gambar' field as an array
        'opsi_barang' => 'array', // Cast the 'gambar' field as an array
    ];

    /**
     * Get the related JenisBarang model.
     */
    public function jenisBarang()
    {
        return $this->belongsTo(JenisBarang::class);
    }
    public function merkBarang()
    {
        return $this->belongsTo(MerkBarang::class);
    }
}
