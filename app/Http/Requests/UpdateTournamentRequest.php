<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTournamentRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'sport' => 'required|string|max:100',
            'tournament_type' => 'required|in:league,knockout,group_knockout,round_robin,double_elimination',
            'max_teams' => 'required|integer|min:2|max:64',
            'teams_per_group' => 'nullable|integer|min:2|max:32',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'status' => 'in:draft,registration_open,ongoing,completed,cancelled,postponed',
            'venue' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'country' => 'nullable|string|max:255',
            'entry_fee' => 'nullable|numeric|min:0',
            'prize_pool' => 'nullable|string|max:255',
            'rules' => 'nullable|string|max:2000',
            'description' => 'nullable|string|max:2000',
            'organizer' => 'nullable|string|max:255',
            'contact_email' => 'nullable|email|max:255',
            'contact_phone' => 'nullable|string|max:20',
            'is_published' => 'sometimes|boolean',
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
            'name.required' => 'The tournament name is required.',
            'sport.required' => 'Please select a sport.',
            'tournament_type.required' => 'Please select a tournament type.',
            'max_teams.required' => 'The maximum number of teams is required.',
            'max_teams.min' => 'At least 2 teams are required.',
            'start_date.required' => 'The start date is required.',
            'end_date.required' => 'The end date is required.',
            'end_date.after_or_equal' => 'The end date must be after or equal to the start date.',
            'contact_email.email' => 'Please enter a valid email address.',
        ];
    }
}
