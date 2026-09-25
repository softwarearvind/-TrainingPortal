<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    protected $fillable = [
        'student_id',
        'course_id',
        'batch_id',
        'certificate_no',
        'verification_code',
        'certificate_title',
        'marks',
        'total_marks',
        'grade',
        'completion_date',
        'issue_date',
        'certificate_file',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'marks' => 'decimal:2',
            'total_marks' => 'decimal:2',
            'completion_date' => 'date',
            'issue_date' => 'date',
            'status' => 'boolean',
        ];
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function batch()
    {
        return $this->belongsTo(Batch::class);
    }
}
