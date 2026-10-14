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
 * @parameter int $points
 * @parameter int|null $minute
 * @parameter int|null $period
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
    'match_id', 'player_id', 'team_id', 'score_type', 'points', 'minute',
    'period', 'is_assisted', 'assisted_by',
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
            'points' => 'integer',
            'period' => 'integer',
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

    public function isScoringEvent(): bool
    {
        return $this->points > 0;
    }

    /**
     * Get a human-readable description of the score event.
     */
    public function getEventDescriptionAttribute(): string
    {
        $playerName = $this->player->full_name;
        $minuteText = $this->minute !== null ? " ({$this->minute}')" : '';
        $periodText = $this->period !== null ? " (period {$this->period})" : '';

        return "{$playerName} - {$this->score_type}{$minuteText}{$periodText}";
    }
}
