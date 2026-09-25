<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class OnlineTest extends Model
{
    protected $fillable = [
        'course_id',
        'batch_id',
        'title',
        'slug',
        'description',
        'instructions',
        'duration_minutes',
        'total_marks',
        'passing_marks',
        'start_date',
        'end_date',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'duration_minutes' => 'integer',
            'total_marks' => 'decimal:2',
            'passing_marks' => 'decimal:2',
            'start_date' => 'datetime',
            'end_date' => 'datetime',
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

    public function questions()
    {
        return $this->hasMany(TestQuestion::class);
    }

    public function attempts()
    {
        return $this->hasMany(TestAttempt::class);
    }

    protected static function booted(): void
    {
        static::creating(function ($test) {

            if (empty($test->slug)) {

                $slug = Str::slug($test->title);

                $count = static::where(
                    'slug',
                    'like',
                    $slug . '%'
                )->count();

                $test->slug = $count
                    ? $slug . '-' . ($count + 1)
                    : $slug;
            }
        });

        static::updating(function ($test) {

            if ($test->isDirty('title')) {

                $slug = Str::slug($test->title);

                $count = static::where('slug', 'like', $slug . '%')
                    ->where('id', '!=', $test->id)
                    ->count();

                $test->slug = $count
                    ? $slug . '-' . ($count + 1)
                    : $slug;
            }
        });
    }
}
