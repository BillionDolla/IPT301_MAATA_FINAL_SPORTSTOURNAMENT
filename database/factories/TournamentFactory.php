<?php

namespace Database\Factories;

use App\Models\Tournament;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Tournament>
 */
class TournamentFactory extends Factory
{
    public function definition(): array
    {
        $startDate = fake()->dateTimeBetween('now', '+6 months');
        $city = fake()->randomElement(['Tagbilaran City', 'Panglao', 'Dauis', 'Loboc', 'Carmen', 'Jagna']);

        return [
            'name' => fake()->city().' Cup',
            'sport' => 'football',
            'tournament_type' => fake()->randomElement(['league', 'knockout', 'group_knockout', 'round_robin']),
            'max_teams' => 16,
            'start_date' => $startDate->format('Y-m-d'),
            'end_date' => fake()->dateTimeBetween($startDate, '+8 months')->format('Y-m-d'),
            'status' => 'registration_open',
            'venue' => $city.' Municipal Sports Complex, Bohol',
            'city' => $city,
            'country' => 'Philippines',
            'entry_fee' => 0,
            'organizer' => fake()->name(),
            'contact_email' => fake()->companyEmail(),
            'is_published' => true,
        ];
    }
}
