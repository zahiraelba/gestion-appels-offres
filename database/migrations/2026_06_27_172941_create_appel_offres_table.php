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
        Schema::create('appel_offres', function (Blueprint $table) {
            $table->id();
            $table->string('reference');
            $table->string('titre');
            $table->text('description');
            $table->decimal('budget_estime',10,2);
            $table->string('statut');
            $table->date('date_limite');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appel_offres');
    }
};
