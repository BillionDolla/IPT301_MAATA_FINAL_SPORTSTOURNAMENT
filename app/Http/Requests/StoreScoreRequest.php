<?php

namespace App\Http\Requests;

use App\Models\Player;
use App\Models\Score;
use App\Models\SportsMatch;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class StoreScoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, string>
     */
    public function rules(): array
    {
        return [
            'match_id' => 'required|exists:matches,id',
            'player_id' => 'required|exists:players,id',
            'team_id' => 'required|exists:sports_teams,id',
            'score_type' => 'required|in:goal,own_goal,penalty_goal,free_kick,header,volley,assist,penalty_miss,chance_created',
            'minute' => 'nullable|integer|min:1|max:150',
            'second_half' => 'sometimes|integer|min:1|max:2',
            'extra_time_minute' => 'nullable|integer|min:1|max:30',
            'is_assisted' => 'sometimes|boolean',
            'assisted_by' => 'nullable|exists:players,id',
            'description' => 'nullable|string|max:500',
            'video_url' => 'nullable|url|max:500',
            'scored_at' => 'nullable|date',
        ];
    }

    /** @return array<\Closure(Validator): void> */
    public function after(): array
    {
        return [
            function (Validator $validator): void {
                $match = SportsMatch::query()->whereKey($this->input('match_id'))->first();
                $player = Player::query()->whereKey($this->input('player_id'))->first();
                $assistingPlayer = $this->filled('assisted_by')
                    ? Player::query()->whereKey($this->input('assisted_by'))->first()
                    : null;
                $score = $this->route('score');
                $scoreId = $score instanceof Score ? $score->getKey() : null;

                if ($match && $this->filled('team_id') && ! in_array((int) $this->input('team_id'), [$match->home_team_id, $match->away_team_id], true)) {
                    $validator->errors()->add('team_id', 'The selected team is not participating in this match.');
                }

                if ($player && $this->filled('team_id') && $player->team_id !== (int) $this->input('team_id')) {
                    $validator->errors()->add('player_id', 'The selected player must belong to the selected team.');
                }

                if ($assistingPlayer && $this->filled('team_id') && $assistingPlayer->team_id !== (int) $this->input('team_id')) {
                    $validator->errors()->add('assisted_by', 'The assisting player must belong to the selected team.');
                }

                if ($this->filled('player_id') && $this->input('player_id') == $this->input('assisted_by')) {
                    $validator->errors()->add('assisted_by', 'A player cannot assist their own score.');
                }

                if ($this->filled('match_id') && $this->filled('player_id') && $this->filled('score_type') && $this->filled('minute')) {
                    $duplicate = Score::query()
                        ->where('match_id', $this->input('match_id'))
                        ->where('player_id', $this->input('player_id'))
                        ->where('score_type', $this->input('score_type'))
                        ->where('minute', $this->input('minute'))
                        ->when($scoreId, fn ($query) => $query->where('id', '!=', $scoreId))
                        ->exists();

                    if ($duplicate) {
                        $validator->errors()->add('minute', 'This player already has the same event recorded at that minute.');
                    }
                }
            },
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'match_id.required' => 'Please select a match.',
            'match_id.exists' => 'The selected match does not exist.',
            'player_id.required' => 'Please select a player.',
            'player_id.exists' => 'The selected player does not exist.',
            'team_id.required' => 'Please select a team.',
            'team_id.exists' => 'The selected team does not exist.',
            'score_type.required' => 'Please select a score type.',
            'score_type.in' => 'The selected score type is invalid.',
            'minute.integer' => 'The minute must be a number.',
            'minute.min' => 'The minute must be at least 1.',
            'minute.max' => 'The minute must be at most 150.',
            'assisted_by.exists' => 'The selected assisting player does not exist.',
            'video_url.url' => 'Please enter a valid video URL.',
        ];
    }
}
