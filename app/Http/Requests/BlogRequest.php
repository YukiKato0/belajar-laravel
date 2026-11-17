<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class BlogRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'slug' => Str::slug($this->input('slug') ?: $this->input('title', '')),
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'slug' => [
                'required',
                'string',
                'max:255',
                Rule::unique('blogs', 'slug')->ignore($this->route('blog')),
            ],
            'category' => ['required', 'string', 'max:100'],
            'excerpt' => ['required', 'string', 'max:500'],
            'author_name' => ['required', 'string', 'max:255'],
            'author_image_url' => ['nullable', 'url', 'max:2048'],
            'featured_image_url' => ['nullable', 'url', 'max:2048'],
            'content' => ['required', 'string', 'max:50000'],
            'read_time' => ['required', 'integer', 'min:1', 'max:120'],
            'published_at' => ['nullable', 'date'],
            'is_published' => ['sometimes', 'boolean'],
        ];
    }
}
