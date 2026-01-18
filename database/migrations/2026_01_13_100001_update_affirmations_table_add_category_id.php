<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Étape 1 : Supprimer l'ancienne clé étrangère et colonne si elle existe
        if (Schema::hasColumn('affirmations', 'category_id')) {
            Schema::table('affirmations', function (Blueprint $table) {
                // Supprimer la contrainte de clé étrangère
                // Laravel détecte automatiquement le nom de la contrainte
                $table->dropForeign(['category_id']);
            });
            
            Schema::table('affirmations', function (Blueprint $table) {
                $table->dropColumn('category_id');
            });
        }
        
        // Étape 2 : Ajouter la nouvelle colonne avec la bonne clé étrangère
        Schema::table('affirmations', function (Blueprint $table) {
            $table->foreignId('category_id')
                ->nullable()
                ->after('id')
                ->constrained('affirmation_categories')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('affirmations', function (Blueprint $table) {
            if (Schema::hasColumn('affirmations', 'category_id')) {
                $table->dropForeign(['category_id']);
                $table->dropColumn('category_id');
            }
        });
    }
};