<?php

namespace App\Models;

use Database\Factories\ProductFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    /** @use HasFactory<ProductFactory> */
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'description',
        'price',
        'price_unit',
        'icon_class',
        'rating',
        'review_count',
        'is_new',
        'is_best_seller',
        'is_active',
        'sort_order',
        'sku',
        'detail_badge',
        'image_url',
        'detail_highlights',
        'file_requirements',
        'template_pdf_url',
        'template_ai_url',
        'template_psd_url',
        'production_time',
        'minimum_order',
        'sold_count',
        'configuration',
    ];

    protected function casts(): array
    {
        return [
            'rating' => 'decimal:1',
            'is_new' => 'boolean',
            'is_best_seller' => 'boolean',
            'is_active' => 'boolean',
            'detail_highlights' => 'array',
            'configuration' => 'array',
        ];
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
