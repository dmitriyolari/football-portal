<?php

namespace App\Http\Requests\Admin\Post;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


/**
 * @property mixed $category_id
 * @property int[] tags
 */
class StorePostRequest extends FormRequest
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
            'slug'         => ['required', 'string', Rule::unique(Post::class, 'slug')],
            'title'        => ['required', 'string'],
            'preview_text' => ['required', 'string'],
            'text'         => ['required', 'string'],
            'category_id'  => ['nullable', 'int', Rule::exists(Category::class, 'id')],
            'tags'         => ['array', 'nullable'],
            'tags.*'       => ['int', Rule::exists(Tag::class, 'id')],
        ];
    }
}
