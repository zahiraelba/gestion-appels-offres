<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::table('offres', function (Blueprint $table) {

        if (!Schema::hasColumn('offres', 'appel_offre_id')) {

            $table->foreignId('appel_offre_id')
                  ->constrained('appel_offres')
                  ->cascadeOnDelete();

        }

    });
}

public function down(): void
{
    Schema::table('offres', function (Blueprint $table) {
        $table->dropForeign(['appel_offre_id']);
        $table->dropColumn('appel_offre_id');
    });
}
};
