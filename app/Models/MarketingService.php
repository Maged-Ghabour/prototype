<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarketingService extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'icon_svg',
        'color_theme',
        'category_id',
        'sort_order',
        'is_active',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
