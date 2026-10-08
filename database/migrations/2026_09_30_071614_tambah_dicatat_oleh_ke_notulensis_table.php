<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('notulensis', function (Blueprint $table) {
            $table->foreignId('dicatat_oleh')->nullable()->after('catatan')->constrained('users')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('notulensis', function (Blueprint $table) {
            $table->dropForeign(['dicatat_oleh']);
            $table->dropColumn('dicatat_oleh');
        });
    }
};