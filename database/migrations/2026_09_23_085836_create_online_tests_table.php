<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('online_tests', function (Blueprint $table) {

            $table->id();

            $table->foreignId('course_id')
                ->constrained('courses')
                ->cascadeOnDelete();

            $table->foreignId('batch_id')
                ->constrained('batches')
                ->cascadeOnDelete();

            $table->string('title');

            $table->string('slug')
                ->unique();

            $table->text('description')
                ->nullable();

            $table->text('instructions')
                ->nullable();

            $table->integer('duration_minutes')
                ->default(30);

            $table->decimal('total_marks', 8, 2)
                ->default(0);

            $table->decimal('passing_marks', 8, 2)
                ->default(0);

            $table->dateTime('start_date')
                ->nullable();

            $table->dateTime('end_date')
                ->nullable();

            $table->enum('status', [
                'draft',
                'published',
                'closed'
            ])->default('draft');

            $table->timestamps();

            $table->index([
                'course_id',
                'batch_id'
            ]);

            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('online_tests');
    }
};
