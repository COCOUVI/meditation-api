<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DailyQuote;
use Carbon\Carbon;

class DailyQuoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Créer les phrases du jour par défaut pour aujourd'hui
     */
    public function run(): void
    {
        // Phrases par défaut depuis l'app Flutter (home_screen.dart)
        $today = Carbon::today();
        
        DailyQuote::updateOrCreate(
            ['quote_date' => $today],
            [
                'quote_1' => 'La paix intérieure commence par le sourire de l\'âme.', // 00:00 - 11:59
                'quote_2' => 'Chaque jour est une nouvelle opportunité de grandir.', // 12:00 - 22:59
                'quote_3' => 'La gratitude transforme ce que nous avons en suffisance.', // 23:00
                'is_active' => true,
            ]
        );
    }
}

