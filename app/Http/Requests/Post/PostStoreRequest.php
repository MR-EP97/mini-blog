<?php

namespace App\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Enums\Post\PostStatus;

class PostStoreRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'user_id' => ['required',],
            'category_id' => ['required',],
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255',],
            'content' => ['nullable', 'string'],
            'published_at' => ['nullable', 'date'],
            'status' => ['required', Rule::in(array_column(PostStatus::cases(), 'value'))],
        ];
    }
}
