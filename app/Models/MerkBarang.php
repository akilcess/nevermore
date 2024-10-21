<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MerkBarang extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama',
        'logo',
        'deskripsi',
       
    ];
    public function barangs()
    {
        return $this->hasMany(Barang::class);
    }
}
