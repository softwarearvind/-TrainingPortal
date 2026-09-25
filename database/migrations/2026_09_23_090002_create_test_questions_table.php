<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('test_questions', function (Blueprint $table) {

            $table->id();

            $table->foreignId('online_test_id')
                ->constrained('online_tests')
                ->cascadeOnDelete();

            $table->text('question');

            $table->string('option_a');

            $table->string('option_b');

            $table->string('option_c');

            $table->string('option_d');

            $table->enum('correct_answer', [
                'a',
                'b',
                'c',
                'd'
            ]);

            $table->decimal('marks', 8, 2)
                ->default(1);

            $table->integer('sort_order')
                ->default(0);

            $table->timestamps();

            $table->index('online_test_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('test_questions');
    }
};
