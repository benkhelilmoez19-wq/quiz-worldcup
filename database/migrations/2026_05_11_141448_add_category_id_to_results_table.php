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
        Schema::table('results', function (Blueprint $table) {
            // Ajout de la colonne category_id après user_id
            $table->unsignedBigInteger('category_id')->after('user_id');

            // Optionnel : Si vous voulez forcer la relation avec la table categories
            // $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('results', function (Blueprint $table) {
            // Suppression de la colonne si on annule la migration
            $table->dropColumn('category_id');
        });
    }
};