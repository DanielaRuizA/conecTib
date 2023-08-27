<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Carbon;

class UserUpdateRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        //reglas de validación para actualizar un registro
        return [
            'name' => ['required', 'string', 'max:100'],
            'phone' => ['numeric', 'digits:10', 'nullable'],
            'date_of_birth' => ['required', 'date', 'before:'.Carbon::now()->subYears(18)->format('Y-m-d')],
            'city_code' => ['required', 'numeric', 'digits:6'],
        ];
    }
}
