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
    Schema::create('resultat_commissions', function (Blueprint $table) {
        $table->id();

        $table->foreignId('commission_id')->constrained()->onDelete('cascade');
        $table->foreignId('fournisseur_id')->constrained()->onDelete('cascade');

        $table->enum('statut', [
            'Retenu',
            'Non retenu',
            'Écarté'
        ]);

        $table->text('observation')->nullable();

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resultat_commissions');
    }
};
