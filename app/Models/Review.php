<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_id',
        'comment',
        'rating',
        'likes_count',
        'reply',
        'show_on_homepage',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function likes()
    {
        return $this->hasMany(ReviewLike::class);
    }

    public function replies()
    {
        return $this->hasMany(ReviewReply::class);
    }
}
