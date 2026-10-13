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

            if (in_array($score->score_type, ['goal', 'penalty_goal', 'free_kick', 'header', 'volley'], true)) {
                $match->increment('home_score');
            }
        });
    }

    public function definition(): array
    {
        return [
            'match_id' => SportsMatch::factory(),
            'player_id' => Player::factory(),
            'team_id' => SportsTeam::factory(),
            'score_type' => 'goal',
            'minute' => fake()->numberBetween(1, 90),
            'second_half' => 1,
            'is_assisted' => false,
            'scored_at' => now(),
        ];
    }
}
