<?php

namespace Database\Factories;

use App\Models\SportsMatch;
use App\Models\SportsTeam;
use App\Models\Tournament;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<SportsMatch>
 */
class SportsMatchFactory extends Factory
{
    public function definition(): array
    {
        $homeTeam = SportsTeam::factory();
        $awayTeam = SportsTeam::factory();

        return [
            'tournament_id' => Tournament::factory(),
            'home_team_id' => $homeTeam,
            'away_team_id' => $awayTeam,
            'match_type' => 'group',
            'match_datetime' => fake()->dateTimeBetween('now', '+6 months'),
            'venue' => 'Carlos P. Garcia Sports Complex, Tagbilaran City, Bohol',
            'status' => 'scheduled',
        ];
    }
}
