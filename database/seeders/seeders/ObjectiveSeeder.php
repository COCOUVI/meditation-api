<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ObjectiveSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $objectives = [
            'Paix interieur',
            'Reduction du stress',
            'Meilleur sommeil',
            'Concentration',
            'Energie vitale',
            'Creativité',
            'Confiance en soi',
            'Relations harmonieuses',
        ];

        foreach ($objectives as $objective) {
            DB::table('objectives')->insert([
                'name' => $objective,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
