<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\EventParticipant;
use App\Models\Event;

class EventParticipantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $events = Event::take(3)->get();
        
        if ($events->isEmpty()) {
            $this->command->warn('Aucun événement trouvé. Veuillez d\'abord exécuter EventSeeder.');
            return;
        }

        $participants = [
            ['first_name' => 'Jean', 'last_name' => 'Dupont'],
            ['first_name' => 'Marie', 'last_name' => 'Martin'],
            ['first_name' => 'Pierre', 'last_name' => 'Dubois'],
            ['first_name' => 'Sophie', 'last_name' => 'Bernard'],
            ['first_name' => 'Lucas', 'last_name' => 'Moreau'],
        ];

        $statuses = ['registered', 'cancelled', 'attended'];

        foreach ($events as $eventIndex => $event) {
            // Ajouter 1-2 participants par événement
            $participantCount = min(2, count($participants));
            
            for ($i = 0; $i < $participantCount; $i++) {
                $participantIndex = ($eventIndex * 2 + $i) % count($participants);
                $participant = $participants[$participantIndex];
                
                EventParticipant::firstOrCreate(
                    [
                        'event_id' => $event->id,
                        'first_name' => $participant['first_name'],
                        'last_name' => $participant['last_name'],
                    ],
                    [
                        'event_id' => $event->id,
                        'first_name' => $participant['first_name'],
                        'last_name' => $participant['last_name'],
                        'status' => $statuses[array_rand($statuses)],
                        'registered_at' => now()->subDays(rand(1, 10)),
                    ]
                );
            }
        }
    }
}

