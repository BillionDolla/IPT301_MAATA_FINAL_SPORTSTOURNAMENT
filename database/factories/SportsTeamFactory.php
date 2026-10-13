<?php

namespace Database\Factories;

use App\Models\SportsTeam;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<SportsTeam>
 */
class SportsTeamFactory extends Factory
{
    public function definition(): array
    {
        $city = fake()->randomElement(['Tagbilaran City', 'Panglao', 'Dauis', 'Loboc', 'Carmen', 'Jagna']);

        return [
            'name' => fake()->unique()->city().' FC',
            'city' => $city,
            'country' => 'Philippines',
            'founded_year' => fake()->numberBetween(1880, (int) date('Y')),
            'stadium' => $city.' Municipal Sports Complex, Bohol',
            'coach' => fake()->name(),
            'team_color' => fake()->safeHexColor(),
            'description' => fake()->sentence(),
            'is_active' => true,
        ];
    }
}
