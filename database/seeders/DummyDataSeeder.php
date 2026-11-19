<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Pengadu;
use App\Models\Notulensi;
use App\Models\DokumentasiKegiatan;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class DummyDataSeeder extends Seeder
{
    public function run(): void
    {
        // ==========================================
        // 1. USERS
        // ==========================================
        $roles = ['admin', 'petugas', 'pimpinan'];
        $namaDepan = ['Budi', 'Siti', 'Ahmad', 'Dewi', 'Rudi', 'Rina', 'Agus', 'Maya', 'Doni', 'Lina',
                      'Joko', 'Ani', 'Hendra', 'Wati', 'Bambang', 'Sri', 'Eko', 'Nur', 'Yusuf', 'Indah'];
        $namaBelakang = ['Santoso', 'Wijaya', 'Pratama', 'Kusuma', 'Hidayat', 'Lestari', 'Nugroho',
                         'Sari', 'Rahayu', 'Setiawan', 'Purnama', 'Halim', 'Firmansyah', 'Anggraini'];

        // 3 user utama
        User::firstOrCreate(
            ['email' => 'admin@example.com'],
            ['name' => 'Admin', 'password' => Hash::make('password123'), 'role' => 'admin']
        );
        User::firstOrCreate(
            ['email' => 'petugas@example.com'],
            ['name' => 'Petugas', 'password' => Hash::make('password123'), 'role' => 'petugas']
        );
        User::firstOrCreate(
            ['email' => 'pimpinan@example.com'],
            ['name' => 'Pimpinan', 'password' => Hash::make('password123'), 'role' => 'pimpinan']
        );

        // 20 user dummy
        for ($i = 1; $i <= 20; $i++) {
            $nama = $namaDepan[array_rand($namaDepan)] . ' ' . $namaBelakang[array_rand($namaBelakang)];
            User::firstOrCreate(
                ['email' => "user$i@example.com"],
                [
                    'name'     => "$nama $i",
                    'password' => Hash::make('password123'),
                    'role'     => $roles[array_rand($roles)],
                ]
            );
        }

        $users = User::all();
        $this->command->info("✅ Users: {$users->count()} total");

        // ==========================================
        // 2. PENGADUS (50)
        // ==========================================
        $jalan = ['Jl. Merdeka', 'Jl. Sudirman', 'Jl. Thamrin', 'Jl. Gatot Subroto', 'Jl. Ahmad Yani',
                  'Jl. Diponegoro', 'Jl. Pahlawan', 'Jl. Kartini', 'Jl. Veteran', 'Jl. Cendrawasih'];
        $kota = ['Jakarta', 'Bandung', 'Surabaya', 'Yogyakarta', 'Semarang', 'Medan', 'Makassar', 'Palembang'];

        for ($i = 1; $i <= 50; $i++) {
            $nama = $namaDepan[array_rand($namaDepan)] . ' ' . $namaBelakang[array_rand($namaBelakang)];
            $nik = '3273' . str_pad((string)rand(0, 999999999999), 12, '0', STR_PAD_LEFT);
            $alamat = $jalan[array_rand($jalan)] . ' No. ' . rand(1, 200) . ', ' . $kota[array_rand($kota)];
            $telepon = '08' . rand(11, 99) . rand(1000000, 9999999);

            Pengadu::firstOrCreate(
                ['nik' => $nik],
                [
                    'nama'       => $nama,
                    'alamat'     => $alamat,
                    'no_telepon' => $telepon,
                    'scan_ktp'   => null,
                ]
            );
        }

        $pengadus = Pengadu::all();
        $this->command->info("✅ Pengadus: {$pengadus->count()} total");

        // ==========================================
        // 3. NOTULENSIS (60)
        // ==========================================
        $statusList = ['konsultasi', 'dilimpahkan', 'ditindaklanjuti', 'ditangani_jabis', 'selesai'];
        $perihalList = [
            'Konsultasi Hukum Perdata',
            'Permohonan Pendampingan Hukum',
            'Konsultasi Sengketa Tanah',
            'Pengaduan Dugaan Penipuan',
            'Konsultasi Hukum Keluarga',
            'Permohonan Bantuan Hukum Gratis',
            'Konsultasi Hukum Ketenagakerjaan',
            'Pengaduan Pelanggaran Kontrak',
            'Konsultasi Hukum Pidana',
            'Permohonan Mediasi Sengketa',
        ];
        $uraianList = [
            'Pengadu datang untuk berkonsultasi mengenai sengketa tanah warisan yang belum dibagi secara adil.',
            'Pengadu melaporkan dugaan penipuan dalam transaksi jual beli online dengan kerugian material.',
            'Pengadu memohon pendampingan hukum terkait perceraian dan hak asuh anak.',
            'Pengadu mengadukan perusahaan tempatnya bekerja yang tidak membayar upah lembur.',
            'Pengadu berkonsultasi tentang prosedur gugatan wanprestasi atas kontrak kerja sama.',
            'Pengadu meminta bantuan hukum untuk kasus kekerasan dalam rumah tangga.',
            'Pengadu melaporkan sengketa batas tanah dengan tetangga.',
            'Pengadu berkonsultasi tentang pembagian harta gono-gini.',
            'Pengadu mengadukan dugaan penggelapan dana koperasi.',
            'Pengadu memohon mediasi untuk sengketa utang piutang.',
        ];
        $petugasNames = $users->where('role', 'petugas')->pluck('name')->toArray();
        if (empty($petugasNames)) {
            $petugasNames = ['Petugas Default'];
        }

        for ($i = 1; $i <= 60; $i++) {
            $pengadu = $pengadus->random();
            $tgl = Carbon::now()->subDays(rand(1, 365))->subHours(rand(0, 23));
            $jenisKelamin = rand(0, 1) ? 'Laki-laki' : 'Perempuan';

            Notulensi::create([
                'no_registrasi'    => 'REG-' . $tgl->format('Ymd') . '-' . str_pad((string)$i, 4, '0', STR_PAD_LEFT),
                'tanggal_waktu'    => $tgl,
                'pengadu_id'       => $pengadu->id,
                'jenis_kelamin'    => $jenisKelamin,
                'umur'             => rand(18, 70),
                'perihal'          => $perihalList[array_rand($perihalList)],
                'uraian_kronologi' => $uraianList[array_rand($uraianList)],
                'penanganan'       => rand(0, 1) ? 'Sedang ditangani oleh tim hukum.' : null,
                'status'           => $statusList[array_rand($statusList)],
                'pic'              => rand(0, 1) ? $petugasNames[array_rand($petugasNames)] : null,
                'notulis'          => rand(0, 1) ? $petugasNames[array_rand($petugasNames)] : null,
                'catatan'          => rand(0, 1) ? 'Catatan: perlu tindak lanjut minggu depan.' : null,
                'dicatat_oleh'     => $users->random()->id,
            ]);
        }

        $notulensis = Notulensi::all();
        $this->command->info("✅ Notulensis: {$notulensis->count()} total");

        // ==========================================
        // 4. DOKUMENTASI KEGIATAN (80)
        // ==========================================
        $judulList = [
            'Sosialisasi Bantuan Hukum Gratis',
            'Penyuluhan Hukum Masyarakat Desa',
            'Rapat Koordinasi Tim Hukum',
            'Kunjungan Lapangan Kasus Sengketa',
            'Mediasi Sengketa Tanah',
            'Pelatihan Paralegal',
            'Seminar Hukum Nasional',
            'Workshop Pendampingan Korban',
            'Konsultasi Hukum Terbuka',
            'Musyawarah Desa Adat',
        ];

        for ($i = 1; $i <= 80; $i++) {
            DokumentasiKegiatan::create([
                'judul_kegiatan'   => $judulList[array_rand($judulList)],
                'foto'             => 'dokumentasi/kegiatan-' . $i . '.jpg',
                'keterangan'       => 'Dokumentasi kegiatan nomor ' . $i . '.',
                'tanggal_kegiatan' => Carbon::now()->subDays(rand(1, 365))->format('Y-m-d'),
                'user_id'          => $users->random()->id,
                'notulensi_id'     => rand(0, 1) ? $notulensis->random()->id : null,
            ]);
        }

        $this->command->info("✅ Dokumentasi Kegiatan: 80 total");
        $this->command->info('');
        $this->command->info('🎉 SEMUA DATA DUMMY BERHASIL DIBUAT!');
    }
}