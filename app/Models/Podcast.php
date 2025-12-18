<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Podcast extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'show_name',
        'description',
        'external_url',
        'embed_html',
        'is_featured',
        'is_active',
        'listened_at',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
        'listened_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($podcast) {
            if (empty($podcast->slug)) {
                $podcast->slug = Str::slug($podcast->title);
            }
        });

        static::updating(function ($podcast) {
            if ($podcast->isDirty('title') && empty($podcast->slug)) {
                $podcast->slug = Str::slug($podcast->title);
            }
        });
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
