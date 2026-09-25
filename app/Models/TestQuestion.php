<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TestQuestion extends Model
{
    protected $fillable = [
        'online_test_id',
        'question',
        'option_a',
        'option_b',
        'option_c',
        'option_d',
        'correct_answer',
        'marks',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'marks' => 'decimal:2',
            'sort_order' => 'integer',
        ];
    }

    public function test()
    {
        return $this->belongsTo(
            OnlineTest::class,
            'online_test_id'
        );
    }
}
