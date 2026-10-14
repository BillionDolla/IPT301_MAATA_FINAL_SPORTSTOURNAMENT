<?php

namespace Database\Factories;

use App\Models\Player;
use App\Models\SportsTeam;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Player>
 */
class PlayerFactory extends Factory
{
    public function definition(): array
    {
        return [
            'team_id' => SportsTeam::factory(),
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'email' => fake()->unique()->safeEmail(),
            'phone' => fake()->phoneNumber(),
            'date_of_birth' => fake()->dateTimeBetween('-35 years', '-18 years')->format('Y-m-d'),
            'gender' => fake()->randomElement(['male', 'female', 'other']),
            'position' => fake()->randomElement([
                'Goalkeeper', 'Defender', 'Midfielder', 'Forward', 'Guard',
                'Center', 'Pitcher', 'Catcher', 'Setter', 'Libero',
            ]),
            'jersey_number' => fake()->unique()->numberBetween(1, 99),
            'player_status' => 'active',
            'is_captain' => false,
        ];
    }
}
