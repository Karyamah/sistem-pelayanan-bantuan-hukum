<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('notulensis', function (Blueprint $table) {
            $table->id();
            $table->string('no_registrasi')->unique();
            $table->dateTime('tanggal_waktu');
            $table->foreignId('pengadu_id')->constrained('pengadus')->onDelete('cascade');
            $table->string('perihal');
            $table->text('uraian_kronologi');
            $table->text('penanganan')->nullable();
            $table->enum('status', ['baru', 'diproses', 'selesai'])->default('baru');
            $table->foreignId('pic_id')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('notulis_id')->nullable()->constrained('users')->onDelete('set null');
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('notulensis');
    }
};