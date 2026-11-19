
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('dokumentasi_kegiatans', function (Blueprint $table) {
            $table->foreignId('notulensi_id')
                ->nullable()
                ->constrained('notulensis')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('dokumentasi_kegiatans', function (Blueprint $table) {
            $table->dropConstrainedForeignId('notulensi_id');
        });
    }
};
