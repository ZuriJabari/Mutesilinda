<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LibraryActivityLog extends Model
{
    protected $fillable = [
        'user_id',
        'book_id',
        'podcast_id',
        'action',
        'meta',
    ];

    protected $casts = [
        'meta' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function podcast()
    {
        return $this->belongsTo(Podcast::class);
    }
}
