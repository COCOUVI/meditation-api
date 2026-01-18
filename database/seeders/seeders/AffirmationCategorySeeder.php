<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AffirmationCategory;
use App\Models\Affirmation;
use Carbon\Carbon;
use Illuminate\Support\Str;

class AffirmationCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Importe les catégories et affirmations depuis l'app Flutter (affirmation_style_screen.dart)
     */
    public function run(): void
    {
        // Les 6 catégories exactes depuis Flutter avec leurs affirmations
        $categories = [
            [
                'name' => 'Confiance en soi',
                'description' => 'Renforcez votre estime personnelle',
                'color' => '#2196F3', // Colors.blue
                'order' => 1,
                'affirmations' => [
                    'Je suis confiant(e) et capable de réaliser tout ce que je désire.',
                    'Ma confiance en moi grandit chaque jour.',
                    'Je mérite le succès et je l\'attire dans ma vie.',
                    'Je suis unique et précieux(se) tel(le) que je suis.',
                    'Je fais confiance à mes capacités et à mon intuition.',
                ],
            ],
            [
                'name' => 'Paix intérieure',
                'description' => 'Trouvez la sérénité et le calme',
                'color' => '#4CAF50', // Colors.green
                'order' => 2,
                'affirmations' => [
                    'Je suis en paix avec moi-même et avec le monde.',
                    'La paix intérieure habite en moi en tout temps.',
                    'Je libère toutes les tensions et je trouve la sérénité.',
                    'Mon esprit est calme et mon cœur est en paix.',
                    'Je choisis la paix dans chaque pensée et chaque action.',
                ],
            ],
            [
                'name' => 'Abondance',
                'description' => 'Attirez la prospérité et le succès',
                'color' => '#9C27B0', // Colors.purple
                'order' => 3,
                'affirmations' => [
                    'Je suis un aimant à l\'abondance et à la prospérité.',
                    'L\'univers pourvoit à tous mes besoins au-delà de mes attentes.',
                    'Je suis ouvert(e) et réceptif(ve) à l\'abondance infinie.',
                    'La richesse coule vers moi de multiples façons.',
                    'Je mérite d\'abonder dans tous les aspects de ma vie.',
                ],
            ],
            [
                'name' => 'Santé',
                'description' => 'Affirmations pour le bien-être',
                'color' => '#F44336', // Colors.red
                'order' => 4,
                'affirmations' => [
                    'Mon corps est en parfaite santé et pleine vitalité.',
                    'Je nourris mon corps avec des aliments sains et bénéfiques.',
                    'Chaque cellule de mon corps vibre de santé et d\'énergie.',
                    'Je suis reconnaissant(e) pour la santé parfaite de mon corps.',
                    'Mon corps guérit et se régénère naturellement.',
                ],
            ],
            [
                'name' => 'Amour',
                'description' => 'Cultivez l\'amour et les relations',
                'color' => '#E91E63', // Colors.pink
                'order' => 5,
                'affirmations' => [
                    'Je suis digne d\'aimer et d\'être aimé(e) inconditionnellement.',
                    'L\'amour coule vers moi et à travers moi librement.',
                    'J\'attire des relations aimantes et harmonieuses.',
                    'Mon cœur est ouvert et je donne et reçois l\'amour librement.',
                    'Je suis entouré(e) d\'amour et de tendresse.',
                ],
            ],
            [
                'name' => 'Réussite',
                'description' => 'Atteignez vos objectifs',
                'color' => '#FF9800', // Colors.orange
                'order' => 6,
                'affirmations' => [
                    'Je suis destiné(e) à réussir dans tout ce que j\'entreprends.',
                    'Le succès vient naturellement vers moi.',
                    'Je surmonte tous les obstacles avec facilité et grâce.',
                    'Mes efforts sont toujours couronnés de succès.',
                    'Je suis une personne réussie et je continue à grandir.',
                ],
            ],
        ];

        foreach ($categories as $categoryData) {
            // Extraire les affirmations avant de créer la catégorie
            $affirmations = $categoryData['affirmations'];
            unset($categoryData['affirmations']);

            // Créer ou mettre à jour la catégorie
            $category = AffirmationCategory::updateOrCreate(
                ['name' => $categoryData['name']],
                $categoryData
            );

            // Créer les affirmations pour cette catégorie
            foreach ($affirmations as $affirmationText) {
                Affirmation::updateOrCreate(
                    [
                        'category_id' => $category->id,
                        'body' => $affirmationText,
                    ],
                    [
                        'title' => Str::limit($affirmationText, 50),
                        'body' => $affirmationText,
                    ]
                );
            }
        }
    }
}
