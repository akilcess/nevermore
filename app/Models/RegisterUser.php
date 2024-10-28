<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegisterUser extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama',
        'province_id',
        'city_id',
        'nama',
        'alamat',
        'telepon',
        'profil',
        'user_id'
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function province()
    {
        return $this->belongsTo(Provinsi::class);
    }

    public function city()
    {
        return $this->belongsTo(Kabupaten::class);
    }
}
