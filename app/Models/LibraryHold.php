<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LibraryHold extends Model
{
    protected $fillable = [
        'book_id',
        'user_id',
        'status',
        'notified_at',
        'expires_at',
        'fulfilled_at',
        'canceled_at',
    ];

    protected $casts = [
        'notified_at' => 'datetime',
        'expires_at' => 'datetime',
        'fulfilled_at' => 'datetime',
        'canceled_at' => 'datetime',
    ];

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
