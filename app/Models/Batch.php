<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Batch extends Model
{
    protected $fillable = [
        'course_id',
        'trainer_id',
        'name',
        'batch_code',
        'start_date',
        'end_date',
        'start_time',
        'end_time',
        'training_mode',
        'capacity',
        'room',
        'meeting_link',
        'description',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'start_date' => 'date',
            'end_date' => 'date',
            'capacity' => 'integer',
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Course
    |--------------------------------------------------------------------------
    */

    public function course()
    {
        return $this->belongsTo(
            Course::class
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Trainer
    |--------------------------------------------------------------------------
    */

    public function trainer()
    {
        return $this->belongsTo(
            Trainer::class
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Students
    |--------------------------------------------------------------------------
    */

    public function students()
    {
        return $this->belongsToMany(
            Student::class,
            'batch_student'
        )
        ->withPivot([
            'enrolled_at',
            'status'
        ])
        ->withTimestamps();
    }

        public function trainingSessions()
{
    return $this->hasMany(
        TrainingSession::class
    );
}

public function assignments()
{
    return $this->hasMany(
        Assignment::class
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
    | Helpers
    |--------------------------------------------------------------------------
    */

    public function getStudentCountAttribute()
    {
        return $this->students()->count();
    }

    public function getAvailableSeatsAttribute()
    {
        return max(
            0,
            $this->capacity - $this->student_count
        );
    }


}
