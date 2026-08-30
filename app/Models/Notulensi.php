<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Notulensi extends Model
{
    use HasFactory;
   protected $fillable = [
    'no_registrasi',
    'tanggal_waktu',
    'pengadu_id',
    'jenis_kelamin',
    'umur',
    'perihal',
    'uraian_kronologi',
    'penanganan',
    'status',
    'pic',
    'notulis',
    'catatan',
];
    protected $casts = [
        'tanggal_waktu' => 'datetime',
    ];

    public function pengadu()
    {
        return $this->belongsTo(Pengadu::class);
    }
}