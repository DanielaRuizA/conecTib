<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['string', 'max:255'],
            'email' => ['email', 'max:255', Rule::unique(User::class)->ignore($this->user()->id)],
            'phone' => ['numeric', 'digits:10', 'nullable'],
            'identification_number' => ['required', 'max:11'],
            'date_of_birth' => ['required', 'date', 'before:'.Carbon::now()->subYears(18)->format('Y-m-d')],
            'city_code' => ['required', 'numeric', 'digits:6'],
        ];
    }
}
