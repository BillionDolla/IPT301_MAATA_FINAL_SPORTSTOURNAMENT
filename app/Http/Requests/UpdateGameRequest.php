<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateGameRequest extends FormRequest
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
            'tournament_id' => 'required|exists:tournaments,id',
            'home_team_id' => 'required|exists:sports_teams,id',
            'away_team_id' => 'required|exists:sports_teams,id|different:home_team_id',
            'match_type' => 'required|in:group,quarter_final,semi_final,final,third_place,round_of_16,round_of_32,friendly,playoff',
            'group_name' => 'nullable|string|max:50',
            'round_number' => 'nullable|integer|min:1',
            'match_datetime' => 'required|date',
            'venue' => 'nullable|string|max:255',
            'stadium' => 'nullable|string|max:255',
            'status' => 'in:scheduled,in_progress,completed,postponed,cancelled,abandoned,forfeited,drawn',
            'home_score' => 'sometimes|integer|min:0',
            'away_score' => 'sometimes|integer|min:0',
            'overtime' => 'sometimes|boolean',
            'home_score_ot' => 'sometimes|integer|min:0',
            'away_score_ot' => 'sometimes|integer|min:0',
            'penalty_shootout' => 'sometimes|boolean',
            'home_score_penalties' => 'sometimes|integer|min:0',
            'away_score_penalties' => 'sometimes|integer|min:0',
            'referee' => 'nullable|string|max:255',
            'assistant_referee_1' => 'nullable|string|max:255',
            'assistant_referee_2' => 'nullable|string|max:255',
            'fourth_official' => 'nullable|string|max:255',
            'match_notes' => 'nullable|string|max:2000',
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
            'tournament_id.required' => 'Please select a tournament.',
            'tournament_id.exists' => 'The selected tournament does not exist.',
            'home_team_id.required' => 'Please select the home team.',
            'home_team_id.exists' => 'The selected home team does not exist.',
            'away_team_id.required' => 'Please select the away team.',
            'away_team_id.exists' => 'The selected away team does not exist.',
            'away_team_id.different' => 'The away team must be different from the home team.',
            'match_datetime.required' => 'The match date and time is required.',
            'match_datetime.date' => 'Please enter a valid date and time.',
        ];
    }
}
