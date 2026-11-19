<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notulensi extends Model
{
    use HasFactory;

    public const STATUS = [
        'konsultasi'      => ['label' => 'Diberikan Konsultasi Hukum',            'short' => 'Konsultasi Hukum',     'badge' => 'bg-info text-dark',    'icon' => 'bi-chat-dots'],
        'dilimpahkan'     => ['label' => 'Dilimpahkan ke Tim Jabis',              'short' => 'Dilimpahkan ke Jabis', 'badge' => 'bg-primary',           'icon' => 'bi-send'],
        'ditindaklanjuti' => ['label' => 'Ditindaklanjuti oleh Pihak Biro Hukum', 'short' => 'Ditindaklanjuti',      'badge' => 'bg-warning text-dark', 'icon' => 'bi-hourglass-split'],
        'ditangani_jabis' => ['label' => 'Ditangani Tim Jabis',                   'short' => 'Ditangani Jabis',     'badge' => 'bg-secondary',         'icon' => 'bi-people'],
        'selesai'         => ['label' => 'Selesai',                               'short' => 'Selesai',             'badge' => 'bg-success',           'icon' => 'bi-check-circle'],
    ];

    public const PERIHAL = [
        'Sengketa Tanah',
        'Sengketa Waris',
        'Perkara Pidana Umum',
        'Pidana Anak',
        'Kasus Ingkar Janji / Penipuan',
        'Kekerasan dalam Rumah Tangga (KDRT)',
        'Perceraian / Hukum Keluarga',
        'Perkara Ketenagakerjaan',
        'Utang Piutang',
    ];

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
        'dicatat_oleh',
    ];

    protected $casts = [
        'tanggal_waktu' => 'datetime',
    ];

    public function getStatusLabelAttribute(): string
    {
        return self::STATUS[$this->status]['label'] ?? ucfirst((string) $this->status);
    }

    public function getStatusBadgeAttribute(): string
    {
        return self::STATUS[$this->status]['badge'] ?? 'bg-secondary';
    }

    public function pengadu()
    {
        return $this->belongsTo(Pengadu::class);
    }

    public function pencatat()
    {
        return $this->belongsTo(User::class, 'dicatat_oleh');
    }

    public function dokumentasiKegiatans()
    {
        return $this->hasMany(DokumentasiKegiatan::class);
    }
}