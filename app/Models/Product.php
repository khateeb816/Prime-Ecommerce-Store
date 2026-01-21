<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'brand_id',
        'name',
        'slug',
        'description',
        'price',
        'old_price',
        'discounted_price', // This seems redundant if we have price and old_price, but following schema
        'discount_percent',
        'image', // Main image
        'is_on_sale',
        'rating',
        'reviews_count',
        'is_featured',
        'model',
        'stock_status',
        'specifications', // JSON
    ];

    protected $casts = [
        'specifications' => 'array',
        'is_on_sale' => 'boolean',
        'is_featured' => 'boolean',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class)->orderBy('sort_order');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function attributeValues()
    {
        return $this->hasMany(ProductAttributeValue::class);
    }
    
    public function wishlistedBy()
    {
        return $this->belongsToMany(User::class, 'wishlists');
    }
}
