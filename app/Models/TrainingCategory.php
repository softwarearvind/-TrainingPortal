<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class TrainingCategory extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'image',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'status' => 'boolean',
        ];
    }

    protected static function booted(): void
    {
        static::creating(function ($category) {

            if (empty($category->slug)) {

                $category->slug = Str::slug(
                    $category->name
                );

            }

        });

        static::updating(function ($category) {

            if ($category->isDirty('name')) {

                $category->slug = Str::slug(
                    $category->name
                );

            }

        });
    }

    public function courses()
{
    return $this->hasMany(Course::class, 'category_id');
}
}
