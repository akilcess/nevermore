<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestStok extends Model
{
    use HasFactory;
    protected $fillable = [
        'barang_id',
        'stok_awal',
        'request_stok',
        'status',
    ];

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }
}
