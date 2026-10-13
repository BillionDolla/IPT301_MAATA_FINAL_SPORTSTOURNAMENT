<?php

namespace App\Http\Requests;

use App\Models\Player;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePlayerRequest extends FormRequest
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
        $player = $this->route('player');
        $playerId = $player instanceof Player ? $player->getKey() : $player;

        return [
            'team_id' => 'required|exists:sports_teams,id',
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'email' => 'nullable|email|max:255|unique:players,email,'.$playerId,
            'phone' => 'nullable|string|max:20',
            'date_of_birth' => 'nullable|date|before:today',
            'gender' => 'nullable|in:male,female,other',
            'position' => 'nullable|in:goalkeeper,defender,midfielder,forward,striker,captain,substitute',
            'jersey_number' => 'nullable|integer|min:1|max:99',
            'height' => 'nullable|numeric|min:100|max:250',
            'weight' => 'nullable|numeric|min:30|max:200',
            'dominant_foot' => 'nullable|in:left,right,both',
            'player_status' => 'in:active,injured,suspended,retired,loaned_out',
            'notes' => 'nullable|string|max:1000',
            'is_captain' => 'sometimes|boolean',
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
            'team_id.required' => 'Please select a team for this player.',
            'team_id.exists' => 'The selected team does not exist.',
            'first_name.required' => 'The first name is required.',
            'last_name.required' => 'The last name is required.',
            'email.email' => 'Please enter a valid email address.',
            'date_of_birth.before' => 'The date of birth must be before today.',
            'jersey_number.integer' => 'The jersey number must be a number.',
            'jersey_number.min' => 'The jersey number must be at least 1.',
            'jersey_number.max' => 'The jersey number must be at most 99.',
        ];
    }
}
