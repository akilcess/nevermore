<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provinsi extends Model
{
    use HasFactory;
    protected $fillable = [
        'province_id',
        'province',
    ];

    // Specify the primary key
    protected $primaryKey = 'province_id';

    // Disable auto-incrementing (since it's not an integer)
    public $incrementing = false;

    // Set the type of the primary key to string
    protected $keyType = 'string';
    public function kabupatens()
    {
        return $this->hasMany(Kabupaten::class, 'province_id');
    }
    
    
}
