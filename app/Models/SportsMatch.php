<?php

namespace App\Models;

use Database\Factories\SportsMatchFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property int $tournament_id
 * @property int $home_team_id
 * @property int $away_team_id
 * @property string $match_type
 * @property string|null $group_name
 * @property int|null $round_number
 * @property Carbon $match_datetime
 * @property string|null $venue
 * @property string|null $stadium
 * @property string $status
 * @property int $home_score
 * @property int $away_score
 * @property bool $overtime
 * @property int $home_score_ot
 * @property int $away_score_ot
 * @property bool $penalty_shootout
 * @property int $home_score_penalties
 * @property int $away_score_penalties
 * @property string|null $match_notes
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property-read Tournament $tournament
 * @property-read SportsTeam $homeTeam
 * @property-read SportsTeam $awayTeam
 * @property-read Collection<int, Score> $scores
 */
#[Fillable([
    'tournament_id', 'home_team_id', 'away_team_id', 'match_type', 'group_name',
    'round_number', 'match_datetime', 'venue', 'stadium', 'status',
    'home_score', 'away_score', 'overtime', 'home_score_ot', 'away_score_ot',
    'penalty_shootout', 'home_score_penalties', 'away_score_penalties',
    'referee', 'assistant_referee_1', 'assistant_referee_2', 'fourth_official',
    'match_notes',
])]
class SportsMatch extends Model
{
    protected $table = 'matches';

    /** @use HasFactory<SportsMatchFactory> */
    use HasFactory, SoftDeletes;

    protected function casts(): array
    {
        return [
            'match_datetime' => 'datetime',
            'overtime' => 'boolean',
            'penalty_shootout' => 'boolean',
            'home_score' => 'integer',
            'away_score' => 'integer',
            'home_score_ot' => 'integer',
            'away_score_ot' => 'integer',
            'home_score_penalties' => 'integer',
            'away_score_penalties' => 'integer',
            'round_number' => 'integer',
        ];
    }

    /** @return BelongsTo<Tournament, $this> */
    public function tournament(): BelongsTo
    {
        return $this->belongsTo(Tournament::class);
    }

    /** @return BelongsTo<SportsTeam, $this> */
    public function homeTeam(): BelongsTo
    {
        return $this->belongsTo(SportsTeam::class, 'home_team_id');
    }

    /** @return BelongsTo<SportsTeam, $this> */
    public function awayTeam(): BelongsTo
    {
        return $this->belongsTo(SportsTeam::class, 'away_team_id');
    }

    /** @return HasMany<Score, $this> */
    public function scores(): HasMany
    {
        return $this->hasMany(Score::class, 'match_id');
    }

    public function totalPoints(): int
    {
        $total = $this->home_score + $this->away_score;
        if ($this->overtime) {
            $total += $this->home_score_ot + $this->away_score_ot;
        }
        if ($this->penalty_shootout) {
            $total += $this->home_score_penalties + $this->away_score_penalties;
        }

        return $total;
    }

    public function winner(): ?SportsTeam
    {
        if ($this->status !== 'completed') {
            return null;
        }
        if ($this->home_score > $this->away_score) {
            return $this->homeTeam;
        }
        if ($this->away_score > $this->home_score) {
            return $this->awayTeam;
        }

        return null;
    }

    public function isInProgress(): bool
    {
        return $this->status === 'in_progress';
    }

    public function isCompleted(): bool
    {
        return $this->status === 'completed';
    }
}
