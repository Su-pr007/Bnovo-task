<?php

namespace App\Http\Requests\Guests;

use Illuminate\Foundation\Http\FormRequest;

class GuestRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'string|required',
            'surname' => 'string|required',
            'phone' => 'string|required|unique:guests',
            'email' => 'string|unique:guests',
            'country' => 'string|min:3|max:3',
        ];
    }
}
