<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Book extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'author',
        'isbn',
        'description',
        'cover_image',
        'is_featured',
        'is_active',
        'published_at',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
        'published_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($book) {
            if (empty($book->slug)) {
                $book->slug = Str::slug($book->title);
            }
        });

        static::updating(function ($book) {
            if ($book->isDirty('title') && empty($book->slug)) {
                $book->slug = Str::slug($book->title);
            }
        });
    }

    public function getCoverImageAttribute($value)
    {
        if (! $value) {
            return $value;
        }

        if (str_starts_with($value, 'http') || str_starts_with($value, '/')) {
            return $value;
        }

        return Storage::disk('public')->url($value);
    }

    public function loans()
    {
        return $this->hasMany(LibraryLoan::class);
    }

    public function holds()
    {
        return $this->hasMany(LibraryHold::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function isAvailable(): bool
    {
        return !$this->loans()
            ->whereIn('status', ['approved', 'checked_out'])
            ->exists();
    }
}
