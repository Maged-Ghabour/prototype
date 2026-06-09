<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;

/**
 * Prototype Model
 *
 * يمثّل نموذجاً تجريبياً واحداً يتكون من كود HTML وCSS وJS.
 * يمكن مشاركته مع العملاء عبر رابط فريد.
 *
 * @property int         $id
 * @property string      $title
 * @property string      $slug
 * @property string      $html_code
 * @property string      $css_code
 * @property string      $js_code
 * @property bool        $is_public
 * @property int|null    $category_id
 * @property Category|null $category
 */
class Prototype extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'html_code',
        'css_code',
        'js_code',
        'is_public',
        'is_visible_on_home',
        'thumbnail',
        'status',
    ];

    protected $casts = [
        'is_public' => 'boolean',
        'is_visible_on_home' => 'boolean',
        'status' => \App\Enums\PrototypeStatus::class,
    ];

    // ── Boot: توليد الـ slug تلقائياً ─────────────────────────────
    protected static function boot(): void
    {
        parent::boot();

        static::creating(function (Prototype $prototype) {
            if (empty($prototype->slug)) {
                $prototype->slug = static::generateUniqueSlug($prototype->title);
            }
        });

        static::updating(function (Prototype $prototype) {
            if ($prototype->isDirty('title') && !$prototype->isDirty('slug')) {
                $prototype->slug = static::generateUniqueSlug($prototype->title, $prototype->id);
            }
        });
    }

    /**
     * توليد slug فريد من العنوان.
     */
    public static function generateUniqueSlug(string $title, ?int $exceptId = null): string
    {
        $base = Str::slug($title);
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

    // ── العلاقات ──────────────────────────────────────────────────

    /** التصنيفات التي ينتمي إليها النموذج (many-to-many) */
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    /** الوسوم المرتبطة بالنموذج (many-to-many) */
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'prototype_tag');
    }

    /** دراسة الحالة المرتبطة بالنموذج */
    public function caseStudy(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(CaseStudy::class);
    }

    /** ملاحظات العملاء على النموذج */
    public function clientNotes(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(ClientNote::class);
    }

    // ── Helpers ───────────────────────────────────────────────────

    /** رابط المعاينة العامة */
    public function getPreviewUrl(): string
    {
        return route('prototype.preview', ['slug' => $this->slug]);
    }
}
