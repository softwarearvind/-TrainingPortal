<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trainer extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'qualification',
        'experience',
        'specialization',
        'bio',
        'image',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'status' => 'boolean',
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Courses
    |--------------------------------------------------------------------------
    */

    public function courses()
    {
        return $this->belongsToMany(
            Course::class,
            'course_trainer'
        )->withTimestamps();
    }

    public function batches()
{
    return $this->hasMany(
        Batch::class
    );
}
}
