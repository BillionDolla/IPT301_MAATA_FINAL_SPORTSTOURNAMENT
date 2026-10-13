<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSportsTeamRequest extends FormRequest
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
            'city' => 'nullable|string|max:255',
            'country' => 'nullable|string|max:255',
            'founded_year' => 'nullable|integer|min:1850|max:'.date('Y'),
            'stadium' => 'nullable|string|max:255',
            'coach' => 'nullable|string|max:255',
            'team_color' => 'nullable|string|max:100',
            'description' => 'nullable|string|max:2000',
            'is_active' => 'sometimes|boolean',
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
            'name.required' => 'The team name is required.',
            'founded_year.integer' => 'The founded year must be a valid year.',
            'founded_year.min' => 'The founded year must be after :min.',
            'founded_year.max' => 'The founded year must not be after :max.',
        ];
    }
}
