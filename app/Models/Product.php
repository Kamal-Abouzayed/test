<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_en', 'name_ar', 'image', 'price', 'buy', 'views'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
