<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Video extends Model
{
    protected $fillable = [
        'course_id',
        'training_session_id',
        'title',
        'slug',
        'description',
        'video_type',
        'video_url',
        'video_file',
        'thumbnail',
        'duration',
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
        static::creating(function ($video) {

            if (empty($video->slug)) {
                $video->slug = Str::slug($video->title);
            }
        });

        static::updating(function ($video) {

            if ($video->isDirty('title')) {
                $video->slug = Str::slug($video->title);
            }
        });
    }
}
