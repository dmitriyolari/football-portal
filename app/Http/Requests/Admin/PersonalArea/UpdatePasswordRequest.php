<?php

namespace App\Http\Requests\Admin\PersonalArea;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property string|int password
 */
class UpdatePasswordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'current_password'      => ['required', 'password'],
            'password'              => ['required', 'confirmed'],
        ];
    }
}
