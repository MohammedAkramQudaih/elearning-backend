<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    //
    use HasFactory;

    protected $fillable = ['title', 'content', 'image', 'date', 'status'];

    protected $casts = [
        'title' => 'array',
        'content' => 'array',
        'date' => 'date',
    ];

    public function getImageUrlAttribute()
    {
        return $this->image ? asset('storage/' . $this->image) : null;
    }
}
