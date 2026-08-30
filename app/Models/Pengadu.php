<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengadu extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'nik',
        'alamat',
        'no_telepon',
        'scan_ktp',
    ];

    public function notulensis()
    {
        return $this->hasMany(Notulensi::class);
    }
}