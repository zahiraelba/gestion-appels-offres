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
    Schema::create('document_fournisseurs', function (Blueprint $table) {
        $table->id();

        $table->foreignId('fournisseur_id')
              ->constrained('fournisseurs')
              ->onDelete('cascade');

        $table->enum('type_document', [
            'Registre de Commerce',
            'ICE',
            'Idenifiant Fiscal',
            'CNSS',
            'Attestation Fiscale',
            'RIB',
        ]);

        $table->string('nom_fichier');
        $table->string('chemin_fichier');

        $table->enum('statut', [
            'En attente',
            'Validé',
            'Refusé',
        ])->default('En attente');

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('document_fournisseurs');
    }
};
