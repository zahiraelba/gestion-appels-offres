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
        Schema::create('commissions', function (Blueprint $table) {

    $table->id();

    $table->foreignId('appel_offre_id')
          ->constrained('appel_offres')
          ->cascadeOnDelete();

    $table->date('date_commission');

    $table->time('heure');

    $table->string('lieu');

    $table->enum('statut', [
        'Programmée',
        'Terminée'
    ])->default('Programmée');

    $table->timestamps();

});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commissions');
    }
};
