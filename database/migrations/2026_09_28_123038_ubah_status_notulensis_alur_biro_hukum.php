<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("ALTER TABLE notulensis MODIFY status VARCHAR(30) NOT NULL DEFAULT 'konsultasi'");

        DB::table('notulensis')->where('status', 'baru')->update(['status' => 'konsultasi']);
        DB::table('notulensis')->where('status', 'diproses')->update(['status' => 'ditindaklanjuti']);
    }

    public function down(): void
    {
        DB::table('notulensis')
            ->whereIn('status', ['dilimpahkan', 'ditindaklanjuti', 'ditangani_jabis'])
            ->update(['status' => 'diproses']);
        DB::table('notulensis')->where('status', 'konsultasi')->update(['status' => 'baru']);

        DB::statement("ALTER TABLE notulensis MODIFY status ENUM('baru','diproses','selesai') NOT NULL DEFAULT 'baru'");
    }
};