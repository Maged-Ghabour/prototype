<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ClientNote extends Model
{
    protected $fillable = [
        'prototype_id',
        'author_name',
        'note',
    ];

    public function prototype(): BelongsTo
    {
        return $this->belongsTo(Prototype::class);
    }
}
