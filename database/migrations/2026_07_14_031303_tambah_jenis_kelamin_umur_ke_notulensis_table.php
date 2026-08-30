<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('notulensis', function (Blueprint $table) {
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan'])->nullable()->after('pengadu_id');
            $table->unsignedTinyInteger('umur')->nullable()->after('jenis_kelamin');
        });
    }

    public function down(): void
    {
        Schema::table('notulensis', function (Blueprint $table) {
            $table->dropColumn(['jenis_kelamin', 'umur']);
        });
    }
};