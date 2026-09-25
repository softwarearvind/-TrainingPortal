<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Course extends Model
{
    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'description',
        'training_mode',
        'duration',
        'fee',
        'image',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'fee' => 'decimal:2',
            'status' => 'boolean',
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Category
    |--------------------------------------------------------------------------
    */

    public function category()
    {
        return $this->belongsTo(
            TrainingCategory::class,
            'category_id'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Trainers
    |--------------------------------------------------------------------------
    */

    public function trainers()
    {
        return $this->belongsToMany(
            Trainer::class,
            'course_trainer'
        )->withTimestamps();
    }

    public function students()
{
    return $this->belongsToMany(
        Student::class,
        'course_student'
    )->withPivot('enrolled_at')
     ->withTimestamps();
}

public function batches()
{
    return $this->hasMany(
        Batch::class
    );
}

public function videos()
{
    return $this->hasMany(Video::class);
}

public function studyMaterials()
{
    return $this->hasMany(
        StudyMaterial::class
    );
}

public function onlineTests()
{
    return $this->hasMany(OnlineTest::class);
}

public function certificates()
{
    return $this->hasMany(Certificate::class);
}

    /*
    |--------------------------------------------------------------------------
    | Auto Slug
    |--------------------------------------------------------------------------
    */

    protected static function booted(): void
    {
        static::creating(function ($course) {

            if (empty($course->slug)) {
                $course->slug = Str::slug(
                    $course->name
                );
            }

        });

        static::updating(function ($course) {

            if ($course->isDirty('name')) {
                $course->slug = Str::slug(
                    $course->name
                );
            }

        });
    }
}
