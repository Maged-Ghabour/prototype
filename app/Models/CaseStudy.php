<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class CaseStudy extends Model
{
    protected $fillable = [
        'project_name',
        'client_name',
        'slug',
        'industry',
        'short_description',
        'challenge',
        'solution',
        'results',
        'featured_image',
        'gallery_images',
        'prototype_id',
        'is_published',
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'gallery_images' => 'array',
    ];

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function (CaseStudy $caseStudy) {
            if (empty($caseStudy->slug)) {
                $caseStudy->slug = static::generateUniqueSlug($caseStudy->project_name);
            }
        });

        static::updating(function (CaseStudy $caseStudy) {
            if ($caseStudy->isDirty('project_name') && !$caseStudy->isDirty('slug')) {
                $caseStudy->slug = static::generateUniqueSlug($caseStudy->project_name, $caseStudy->id);
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

    public function prototype(): BelongsTo
    {
        return $this->belongsTo(Prototype::class);
    }
}
