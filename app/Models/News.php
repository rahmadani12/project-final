<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $fillable = [
        'country_id',
        'title',
        'source',
        'category',
        'published_at',
        'description',
        'risk_level',
    ];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}