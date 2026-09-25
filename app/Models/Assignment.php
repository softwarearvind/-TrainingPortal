<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Assignment extends Model
{
    protected $fillable = [
        'course_id',
        'batch_id',
        'title',
        'slug',
        'description',
        'instructions',
        'attachment',
        'attachment_name',
        'attachment_size',
        'total_marks',
        'start_date',
        'due_date',
        'allow_late_submission',
        'late_penalty',
        'sort_order',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'total_marks' => 'decimal:2',
            'late_penalty' => 'decimal:2',
            'start_date' => 'datetime',
            'due_date' => 'datetime',
            'allow_late_submission' => 'boolean',
            'sort_order' => 'integer',
        ];
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function batch()
    {
        return $this->belongsTo(Batch::class);
    }

    public function submissions()
    {
        return $this->hasMany(
            AssignmentSubmission::class
        );
    }

    protected static function booted(): void
    {
        static::creating(function ($assignment) {

            if (empty($assignment->slug)) {

                $assignment->slug =
                    Str::slug($assignment->title);
            }
        });

        static::updating(function ($assignment) {

            if ($assignment->isDirty('title')) {

                $assignment->slug =
                    Str::slug($assignment->title);
            }
        });
    }
}
