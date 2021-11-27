<?php

namespace App\Http\Requests\Admin\Category;

use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCategoryRequest extends FormRequest
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
            'slug'         => [
                'required',
                'string',
                Rule::unique(Category::class, 'slug')->ignore($this->route('category')),
            ],
            'title'        => ['required', 'string'],
            'preview_text' => ['required', 'string'],
        ];
    }
}
