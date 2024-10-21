<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kabupaten extends Model
{
    use HasFactory;
    protected $fillable = [
        'city_id',
        'province_id',
        'city_name',
    ];

    // Specify the primary key
    protected $primaryKey = 'city_id';

    // Disable auto-incrementing (since it's not an integer)
    public $incrementing = false;

    // Set the type of the primary key to string
    protected $keyType = 'string';

    public function provinsi()
    {
        return $this->belongsTo(Provinsi::class, 'province_id');
    }
    
    
}
