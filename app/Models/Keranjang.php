<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keranjang extends Model
{
    use HasFactory;

    protected $fillable = [
        'barang_id',
        'user_id',
        'opsi_barang',
        'quantity',
        'total_harga',
    ];

    protected $casts = [
        'opsi_barang' => 'array',  // Cast opsi_barang as an array
    ];

    // Relationship with the Barang model
    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }

    // Relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
