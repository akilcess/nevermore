<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Checkout extends Model
{
    use HasFactory;
    protected $fillable = [
        'barang',
        'user_id',
        'status',
        'total_harga',
        'status',
        'bukti_pembayaran',
        'no_resi',
    ];

    protected $casts = [
        'barang' => 'array',  // Cast barang_id as an array
     
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
    public function detailuser()
    {
        return $this->belongsTo(RegisterUser::class);
    }

   
}
