<?php

namespace App\Models;

use Database\Factories\PlayerFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property int $team_id
 * @property string $first_name
 * @property string $last_name
 * @property string $full_name
 * @property string|null $email
 * @property string|null $phone
 * @property Carbon|null $date_of_birth
 * @property string|null $gender
 * @property string|null $position
 *
 * @parameter int|null $jersey_number
 * @parameter float|null $height
 * @parameter float|null $weight
 * @parameter string|null $dominant_foot
 * @parameter string $player_status
 * @parameter string|null $notes
 * @parameter bool $is_captain
 *
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property-read SportsTeam $team
 * @property-read Collection<int, Score> $scores
 * @property-read Collection<int, Score> $assists
 */
#[Fillable([
    'team_id', 'first_name', 'last_name', 'full_name', 'email', 'phone',
    'date_of_birth', 'gender', 'position', 'jersey_number', 'height', 'weight',
    'dominant_foot', 'player_status', 'notes', 'is_captain',
])]
class Player extends Model
{
    /** @use HasFactory<PlayerFactory> */
    use HasFactory, SoftDeletes;

    /**
     * The attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'date_of_birth' => 'date',
            'jersey_number' => 'integer',
            'height' => 'decimal:2',
            'weight' => 'decimal:2',
            'is_captain' => 'boolean',
        ];
    }

    /**
     * Get the team this player belongs to.
     *
     * @return BelongsTo<SportsTeam, $this>
     */
    public function team(): BelongsTo
    {
        return $this->belongsTo(SportsTeam::class, 'team_id');
    }

    /**
     * Get all scores this player has recorded.
     *
     * @return HasMany<Score, $this>
     */
    public function scores(): HasMany
    {
        return $this->hasMany(Score::class, 'player_id');
    }

    /**
     * Get all assists this player has recorded.
     *
     * @return HasMany<Score, $this>
     */
    public function assists(): HasMany
    {
        return $this->hasMany(Score::class, 'assisted_by');
    }

    /**
     * Get the player's full name attribute.
     *
     * @return Attribute<string, never>
     */
    protected function fullName(): Attribute
    {
        return Attribute::make(
            get: fn (?string $value, array $attributes) => $value ?: "{$attributes['first_name']} {$attributes['last_name']}",
        );
    }

    /**
     * Get the player's age.
     */
    public function age(): ?int
    {
        if (! $this->date_of_birth) {
            return null;
        }

        return $this->date_of_birth->age;
    }

    /**
     * Get the total points recorded for this player.
     */
    public function totalPoints(): int
    {
        return (int) $this->scores()->sum('points');
    }

    /**
     * Get total assists by this player.
     */
    public function totalAssists(): int
    {
        return $this->assists()->count();
    }
}
