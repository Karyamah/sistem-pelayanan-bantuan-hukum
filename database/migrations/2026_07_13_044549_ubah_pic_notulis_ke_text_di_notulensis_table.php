<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('notulensis', function (Blueprint $table) {
            $table->dropForeign(['pic_id']);
            $table->dropForeign(['notulis_id']);
            $table->dropColumn(['pic_id', 'notulis_id']);
            $table->string('pic')->nullable()->after('status');
            $table->string('notulis')->nullable()->after('pic');
        });
    }

    public function down(): void
    {
        Schema::table('notulensis', function (Blueprint $table) {
            $table->dropColumn(['pic', 'notulis']);
            $table->foreignId('pic_id')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('notulis_id')->nullable()->constrained('users')->onDelete('set null');
        });
    }
};