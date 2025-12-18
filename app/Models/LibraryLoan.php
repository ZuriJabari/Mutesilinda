<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LibraryLoan extends Model
{
    protected $fillable = [
        'book_id',
        'user_id',
        'status',
        'user_note',
        'admin_note',
        'requested_at',
        'approved_at',
        'checked_out_at',
        'due_at',
        'returned_at',
        'rejected_at',
        'canceled_at',
    ];

    protected $casts = [
        'requested_at' => 'datetime',
        'approved_at' => 'datetime',
        'checked_out_at' => 'datetime',
        'due_at' => 'datetime',
        'returned_at' => 'datetime',
        'rejected_at' => 'datetime',
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
