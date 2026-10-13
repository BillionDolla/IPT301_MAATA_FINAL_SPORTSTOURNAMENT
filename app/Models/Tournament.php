<?php

namespace App\Models;

use Database\Factories\TournamentFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string $name
 * @property string $sport
 *
 * @parameter string $tournament_type
 * @parameter int $max_teams
 * @parameter int|null $teams_per_group
 *
 * @property Carbon $start_date
 * @property Carbon $end_date
 *
 * @parameter string $status
 * @parameter string|null $venue
 * @parameter string|null $city
 * @parameter string|null $country
 * @parameter float|null $entry_fee
 * @parameter string|null $prize_pool
 * @parameter string|null $rules
 * @parameter string|null $description
 * @parameter string|null $organizer
 * @parameter string|null $contact_email
 * @parameter string|null $contact_phone
 * @parameter string|null $logo_path
 * @parameter bool $is_published
 *
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property-read Collection<int, SportsMatch> $matches
 */
#[Fillable([
    'name', 'sport', 'tournament_type', 'max_teams', 'teams_per_group',
    'start_date', 'end_date', 'status', 'venue', 'city', 'country',
    'entry_fee', 'prize_pool', 'rules', 'description', 'organizer',
    'contact_email', 'contact_phone', 'logo_path', 'is_published',
])]
class Tournament extends Model
{
    /** @use HasFactory<TournamentFactory> */
    use HasFactory, SoftDeletes;

    /**
     * The attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'start_date' => 'date',
            'end_date' => 'date',
            'entry_fee' => 'decimal:2',
            'max_teams' => 'integer',
            'teams_per_group' => 'integer',
            'is_published' => 'boolean',
        ];
    }

    /**
     * Get all matches that belong to this tournament.
     *
     * @return HasMany<SportsMatch, $this>
     */
    public function matches(): HasMany
    {
        return $this->hasMany(SportsMatch::class, 'tournament_id');
    }

    /**
     * Get the total number of matches played in this tournament.
     */
    public function totalMatches(): int
    {
        return $this->matches()->count();
    }

    /**
     * Get the total number of completed matches in this tournament.
     */
    public function completedMatches(): int
    {
        return $this->matches()->where('status', 'completed')->count();
    }

    /**
     * Get the champion team of the tournament, if completed.
     */
    public function champion(): ?SportsTeam
    {
        $final = $this->matches()
            ->where('match_type', 'final')
            ->where('status', 'completed')
            ->first();

        if ($final) {
            return $final->winner();
        }

        return null;
    }

    /**
     * Determine if the tournament is currently ongoing.
     */
    public function isOngoing(): bool
    {
        return $this->status === 'ongoing';
    }

    /**
     * Determine if the tournament has started.
     */
    public function hasStarted(): bool
    {
        return $this->start_date->isPast();
    }

    /**
     * Determine if the tournament is completed.
     */
    public function isCompleted(): bool
    {
        return $this->status === 'completed';
    }

    /**
     * Get the duration of the tournament in days.
     */
    public function durationDays(): int
    {
        return (int) $this->start_date->diffInDays($this->end_date) + 1;
    }
}
