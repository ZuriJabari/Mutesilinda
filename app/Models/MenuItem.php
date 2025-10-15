<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    protected $fillable = [
        'label',
        'url',
        'is_external',
        'has_dropdown',
        'order',
        'is_active',
    ];

    protected $casts = [
        'is_external' => 'boolean',
        'has_dropdown' => 'boolean',
        'is_active' => 'boolean',
    ];

    public function affiliations()
    {
        return $this->hasMany(Affiliation::class);
    }
}
