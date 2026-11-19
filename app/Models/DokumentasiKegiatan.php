<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DokumentasiKegiatan extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul_kegiatan',
        'foto',
        'keterangan',
        'tanggal_kegiatan',
        'user_id',
        'notulensi_id',
    ];

    protected $casts = [
        'tanggal_kegiatan' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function notulensi()
    {
        return $this->belongsTo(Notulensi::class);
    }
}