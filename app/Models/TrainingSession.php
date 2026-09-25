<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrainingSession extends Model
{
    protected $fillable = [
        'batch_id',
        'trainer_id',
        'title',
        'session_code',
        'topic',
        'session_date',
        'start_time',
        'end_time',
        'training_mode',
        'room',
        'location',
        'meeting_platform',
        'meeting_link',
        'recording_link',
        'notes',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'session_date' => 'date',
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Batch
    |--------------------------------------------------------------------------
    */

    public function batch()
    {
        return $this->belongsTo(
            Batch::class
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
}
