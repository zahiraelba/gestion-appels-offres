<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up()
{
    Schema::create('offres', function (Blueprint $table) {
        $table->id();
        $table->string('titre');
        $table->text('description');
        $table->decimal('montant', 10, 2);
        $table->foreignId('fournisseur_id')->constrained('users');
        $table->foreignId('appel_offre_id')->constrained('appel_offres')->onDelete('cascade');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offres');
    }
};
