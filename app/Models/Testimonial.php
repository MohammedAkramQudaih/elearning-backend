<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    //
    use HasFactory;

    protected $fillable = ['name', 'position', 'content', 'image', 'status', 'student_id'];

    protected $casts = [
        'position' => 'array',
        'content' => 'array',
    ];

    // Accessor للحصول على صورة كاملة المسار
    public function getImageUrlAttribute()
    {
        return $this->image ? asset('storage/' . $this->image) : null;
    }

    public function student()
    {
        return $this->hasOne(Student::class);
    }   
}
