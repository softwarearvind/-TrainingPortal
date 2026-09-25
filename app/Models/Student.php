<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'user_id',
        'admission_no',
        'phone',
        'date_of_birth',
        'gender',
        'qualification',
        'address',
        'city',
        'state',
        'pincode',
        'image',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'date_of_birth' => 'date',
            'status' => 'boolean',
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | User
    |--------------------------------------------------------------------------
    */

    public function user()
    {
        return $this->belongsTo(User::class);
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
            'course_student'
        )->withTimestamps();
    }

    public function batches()
{
    return $this->belongsToMany(
        Batch::class,
        'batch_student'
    )
    ->withPivot([
        'enrolled_at',
        'status'
    ])
    ->withTimestamps();
}
public function certificates()
{
    return $this->hasMany(Certificate::class);
}
}
