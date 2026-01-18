<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class RetreatPlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Récupère les 3 plans de retraite exacts depuis la page Cuisine de l'app Flutter
     */
    public function run(): void
    {
        // Supprimer les anciens plans pour éviter les doublons
        DB::table('retreat_plans')->truncate();

        // Les 3 plans de retraite exacts depuis lib/screens/retreats_screen.dart
        $retreatPlans = [
            [
                'title' => 'Full Recovery',
                'description' => 'Ce plan offre aux participants un full recovery dans les problèmes subtils',
                'duration_days' => 14,
                'cover_image' => null,
                'features' => json_encode([
                    'Accompagnés par TAR, avec des soins sur mesure',
                    'Un programme détaillé du matin jusqu\'au soir',
                    'Des activités spirituelles incluses',
                    'Un chef de cuisine privé',
                ]),
                'tags' => json_encode([
                    'Soins personnalisés',
                    'Programme complet',
                    'Spiritualité',
                    'Cuisine privée',
                ]),
                'services' => json_encode([
                    'Accompagnement TAR',
                    'Soins sur mesure',
                    'Programme détaillé',
                    'Activités spirituelles',
                    'Chef de cuisine privé',
                ]),
                'status' => 'on_request',
                'price' => null, // Prix sur demande
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'L\'Éveil des Sens et de l\'Âme',
                'description' => 'Une immersion de 14 jours dans un espace ZEN où le confort matériel sert de catalyseur à la libération émotionnelle',
                'duration_days' => 14,
                'cover_image' => null,
                'features' => json_encode([
                    'Espace ZEN en pleine nature',
                    'Confort matériel optimal',
                    'Libération émotionnelle',
                    'Immersion totale',
                ]),
                'tags' => json_encode([
                    'Espace ZEN',
                    'Confort',
                    'Libération',
                    'Immersion',
                ]),
                'services' => json_encode([
                    'Espace ZEN',
                    'Confort matériel',
                    'Libération émotionnelle',
                    'Immersion totale',
                ]),
                'status' => 'on_request',
                'price' => null, // Prix sur demande
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'Architecture de l\'Être',
                'description' => 'Un programme structuré autour de 3 piliers pour transformer votre être',
                'duration_days' => 14,
                'cover_image' => null,
                'features' => json_encode([
                    'Pilier I: Libération du Passé (Jour 1-5)',
                    'Pilier II: Alchimie Émotionnelle (Jour 6-9)',
                    'Pilier III: Expansion et Manifestation (Jour 10-14)',
                    'Accompagnement personnalisé',
                ]),
                'tags' => json_encode([
                    '3 piliers',
                    'Transformation',
                    'Accompagnement',
                    'Résultats',
                ]),
                'services' => json_encode([
                    'Pilier I: Libération du Passé',
                    'Pilier II: Alchimie Émotionnelle',
                    'Pilier III: Expansion et Manifestation',
                    'Accompagnement personnalisé',
                ]),
                'status' => 'on_request',
                'price' => null, // Prix sur demande
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        foreach ($retreatPlans as $plan) {
            DB::table('retreat_plans')->insert($plan);
        }
    }
}
