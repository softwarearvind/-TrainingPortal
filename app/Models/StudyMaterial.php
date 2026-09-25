<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class StudyMaterial extends Model
{
    protected $fillable = [
        'course_id',
        'training_session_id',
        'title',
        'slug',
        'description',
        'material_type',
        'file_path',
        'external_url',
        'file_name',
        'file_size',
        'thumbnail',
        'sort_order',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'status' => 'boolean',
            'sort_order' => 'integer',
        ];
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function trainingSession()
    {
        return $this->belongsTo(
            TrainingSession::class,
            'training_session_id'
        );
    }

    protected static function booted(): void
    {
        static::creating(function ($material) {

            if (empty($material->slug)) {
                $material->slug = Str::slug(
                    $material->title
                );
            }
        });

        static::updating(function ($material) {

            if ($material->isDirty('title')) {
                $material->slug = Str::slug(
                    $material->title
                );
            }
        });
    }
}
