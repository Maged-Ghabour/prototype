<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

/**
 * Category Model — نموذج التصنيفات
 *
 * @property int    $id
 * @property string $name
 * @property string $slug
 * @property string $description
 * @property string $color
 * @property int    $sort_order
 */
class Category extends Model
{
    protected $fillable = ['name', 'slug', 'description', 'color', 'sort_order'];

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function (Category $category) {
            if (empty($category->slug)) {
                $category->slug = static::generateUniqueSlug($category->name);
            }
        });
    }

    public static function generateUniqueSlug(string $name, ?int $exceptId = null): string
    {
        $base = Str::slug($name);
        $slug = $base;
        $counter = 1;

        while (
            static::where('slug', $slug)
                ->when($exceptId, fn ($q) => $q->where('id', '!=', $exceptId))
                ->exists()
        ) {
            $slug = $base . '-' . $counter++;
        }

        return $slug;
    }

    /** النماذج التابعة لهذا التصنيف */
    public function prototypes(): HasMany
    {
        return $this->hasMany(Prototype::class);
    }
}
