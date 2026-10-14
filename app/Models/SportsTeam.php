<?php

namespace App\Models;

use Database\Factories\SportsTeamFactory;
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
 * @property string|null $city
 * @property string|null $country
 *
 * @parameter int|null $founded_year
 *
 * @property string|null $stadium
 * @property string|null $coach
 * @property string|null $team_color
 * @property string|null $description
 * @property bool $is_active
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property-read Collection<int, Player> $players
 * @property-read Collection<int, SportsMatch> $homeMatches
 * @property-read Collection<int, SportsMatch> $awayMatches
 * @property-read Collection<int, Score> $scores
 */
#[Fillable(['name', 'city', 'country', 'founded_year', 'stadium', 'coach', 'team_color', 'description', 'is_active'])]
class SportsTeam extends Model
{
    /** @use HasFactory<SportsTeamFactory> */
    use HasFactory, SoftDeletes;

    /**
     * The attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'founded_year' => 'integer',
        ];
    }

    /**
     * Get all players that belong to this team.
     *
     * @return HasMany<Player, $this>
     */
    public function players(): HasMany
    {
        return $this->hasMany(Player::class, 'team_id');
    }

    /**
     * Get all active players for this team.
     *
     * @return HasMany<Player, $this>
     */
    public function activePlayers(): HasMany
    {
        return $this->players()->where('player_status', 'active');
    }

    /**
     * Get the captain of this team.
     */
    public function captain(): ?Player
    {
        return $this->players()->where('is_captain', true)->first();
    }

    /**
     * Get all matches where this team played at home.
     *
     * @return HasMany<SportsMatch, $this>
     */
    public function homeMatches(): HasMany
    {
        return $this->hasMany(SportsMatch::class, 'home_team_id');
    }

    /**
     * Get all matches where this team played away.
     *
     * @return HasMany<SportsMatch, $this>
     */
    public function awayMatches(): HasMany
    {
        return $this->hasMany(SportsMatch::class, 'away_team_id');
    }

    /**
     * Get all scores for this team.
     *
     * @return HasMany<Score, $this>
     */
    public function scores(): HasMany
    {
        return $this->hasMany(Score::class, 'team_id');
    }

    /**
     * Get total points scored by this team across all matches.
     */
    public function totalPointsScored(): int
    {
        return (int) (
            SportsMatch::where('home_team_id', $this->id)->sum('home_score')
            + SportsMatch::where('away_team_id', $this->id)->sum('away_score')
        );
    }

    /**
     * Get total points conceded by this team across all matches.
     */
    public function totalPointsConceded(): int
    {
        return (int) (
            SportsMatch::where('away_team_id', $this->id)->sum('home_score')
            + SportsMatch::where('home_team_id', $this->id)->sum('away_score')
        );
    }

    /**
     * Get the full team display name.
     */
    public function getFullNameAttribute(): string
    {
        return $this->name;
    }
}
