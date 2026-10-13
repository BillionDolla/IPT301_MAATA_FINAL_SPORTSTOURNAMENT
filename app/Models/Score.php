<?php

namespace App\Models;

use Database\Factories\ScoreFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property int $match_id
 * @property int $player_id
 *
 * @parameter int $team_id
 * @parameter string $score_type
 * @parameter int|null $minute
 * @parameter int $second_half
 * @parameter int|null $extra_time_minute
 * @parameter bool $is_assisted
 * @parameter int|null $assisted_by
 * @parameter string|null $description
 * @parameter string|null $video_url
 * @parameter Carbon|null $scored_at
 *
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property-read SportsMatch $match
 * @property-read Player $player
 * @property-read SportsTeam $team
 * @property-read Player|null $assistedBy
 */
#[Fillable([
    'match_id', 'player_id', 'team_id', 'score_type', 'minute',
    'second_half', 'extra_time_minute', 'is_assisted', 'assisted_by',
    'description', 'video_url', 'scored_at',
])]
class Score extends Model
{
    /** @use HasFactory<ScoreFactory> */
    use HasFactory, SoftDeletes;

    /**
     * The attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'minute' => 'integer',
            'second_half' => 'integer',
            'extra_time_minute' => 'integer',
            'is_assisted' => 'boolean',
            'assisted_by' => 'integer',
            'scored_at' => 'datetime',
        ];
    }

    /**
     * Get the match this score belongs to.
     *
     * @return BelongsTo<SportsMatch, $this>
     */
    public function match(): BelongsTo
    {
        return $this->belongsTo(SportsMatch::class, 'match_id');
    }

    /**
     * Get the player who scored.
     *
     * @return BelongsTo<Player, $this>
     */
    public function player(): BelongsTo
    {
        return $this->belongsTo(Player::class);
    }

    /**
     * Get the team this score belongs to.
     *
     * @return BelongsTo<SportsTeam, $this>
     */
    public function team(): BelongsTo
    {
        return $this->belongsTo(SportsTeam::class, 'team_id');
    }

    /**
     * Get the player who assisted this score.
     *
     * @return BelongsTo<Player, $this>
     */
    public function assistedBy(): BelongsTo
    {
        return $this->belongsTo(Player::class, 'assisted_by');
    }

    /**
     * Determine if this score is a goal.
     */
    public function isGoal(): bool
    {
        return in_array($this->score_type, ['goal', 'own_goal', 'penalty_goal', 'free_kick', 'header', 'volley'], true);
    }

    /**
     * Get a human-readable description of the score event.
     */
    public function getEventDescriptionAttribute(): string
    {
        $playerName = $this->player->full_name;
        $minuteText = $this->minute !== null ? " ({$this->minute}')" : '';
        $typeLabel = match ($this->score_type) {
            'goal' => 'Goal',
            'own_goal' => 'Own Goal',
            'penalty_goal' => 'Penalty Goal',
            'free_kick' => 'Free Kick Goal',
            'header' => 'Header Goal',
            'volley' => 'Volley Goal',
            'assist' => 'Assist',
            'penalty_miss' => 'Penalty Miss',
            default => $this->score_type,
        };

        return "{$playerName} - {$typeLabel}{$minuteText}";
    }
}
