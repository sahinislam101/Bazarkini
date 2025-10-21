<?php

namespace App\Models;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory, HasUuids, HasSlug;

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'name',
        'slug',
        'description',
        'small_description',
        'price',
        'discount_price',
        'stock',
        'sku',
        'flash_sales',
        'best_sell',
        'image',
        'status',
        'category_id',
        'brand_id',
    ];

    protected $casts = [
        'status' => 'boolean',
        'flash_sales' => 'boolean',
        'best_sell' => 'boolean',
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug')
            ->doNotGenerateSlugsOnUpdate();
    }

    // 🔗 Relationships

public function category()
{
    return $this->belongsTo(Category::class);
}

// Product belongs to Brand
public function brand()
{
    return $this->belongsTo(Brand::class);
}

// Product has many Images
// public function images()
// {
//     return $this->hasMany(ProductImage::class);
// }

}
