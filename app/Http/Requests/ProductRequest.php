<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'category_id' => ['required', 'exists:categories,id'],
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'price' => ['required', 'integer', 'min:0'],
            'price_unit' => ['required', 'string', 'max:30'],
            'icon_class' => ['nullable', 'string', 'max:100'],
            'rating' => ['nullable', 'numeric', 'between:0,5'],
            'review_count' => ['nullable', 'integer', 'min:0'],
            'is_new' => ['sometimes', 'boolean'],
            'is_best_seller' => ['sometimes', 'boolean'],
            'is_active' => ['sometimes', 'boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'sku' => ['nullable', 'string', 'max:255', Rule::unique('products', 'sku')->ignore($this->route('product'))],
            'detail_badge' => ['nullable', 'string', 'max:100'],
            'image_url' => ['nullable', 'url', 'max:2048'],
            'detail_highlights_json' => ['nullable', 'json'],
            'file_requirements' => ['nullable', 'string', 'max:10000'],
            'template_pdf_url' => ['nullable', 'url', 'max:2048'],
            'template_ai_url' => ['nullable', 'url', 'max:2048'],
            'template_psd_url' => ['nullable', 'url', 'max:2048'],
            'production_time' => ['nullable', 'string', 'max:100'],
            'minimum_order' => ['nullable', 'integer', 'min:1'],
            'sold_count' => ['nullable', 'integer', 'min:0'],
            'configuration_json' => ['nullable', 'json'],
        ];
    }

    protected function passedValidation(): void
    {
        $validated = $this->validated();

        $this->merge([
            'detail_highlights' => filled($validated['detail_highlights_json'] ?? null)
                ? json_decode($validated['detail_highlights_json'], true, flags: JSON_THROW_ON_ERROR)
                : null,
            'configuration' => filled($validated['configuration_json'] ?? null)
                ? json_decode($validated['configuration_json'], true, flags: JSON_THROW_ON_ERROR)
                : null,
        ]);
    }
}
