<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;

/**
 * Tag Model — نموذج الوسوم
 *
 * @property int    $id
 * @property string $name
 * @property string $slug
 * @property string $color
 */
class Tag extends Model
{
    protected $fillable = ['name', 'slug', 'color'];

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function (Tag $tag) {
            if (empty($tag->slug)) {
                $tag->slug = static::generateUniqueSlug($tag->name);
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

    /** النماذج التي تحمل هذا الوسم */
    public function prototypes(): BelongsToMany
    {
        return $this->belongsToMany(Prototype::class, 'prototype_tag');
    }
}
