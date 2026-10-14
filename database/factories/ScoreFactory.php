<?php

namespace Database\Factories;

use App\Models\Player;
use App\Models\Score;
use App\Models\SportsMatch;
use App\Models\SportsTeam;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Score>
 */
class ScoreFactory extends Factory
{
    public function configure(): static
    {
        return $this->afterCreating(function (Score $score): void {
            $match = $score->match;
            $homeTeamId = $match->home_team_id;

            $score->player->update(['team_id' => $homeTeamId]);
            $score->update(['team_id' => $homeTeamId]);

            $match->increment('home_score', $score->points);
        });
    }

    public function definition(): array
    {
        return [
            'match_id' => SportsMatch::factory(),
            'player_id' => Player::factory(),
            'team_id' => SportsTeam::factory(),
            'score_type' => 'Score',
            'points' => 1,
            'minute' => fake()->numberBetween(1, 90),
            'period' => 1,
            'is_assisted' => false,
            'scored_at' => now(),
        ];
    }
}
