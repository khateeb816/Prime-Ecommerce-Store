<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'type', // text, select, boolean
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_attribute');
    }

    public function productValues()
    {
        return $this->hasMany(ProductAttributeValue::class);
    }
    
    // Helper to get allowed values if we decide to enforce specific values later
}
