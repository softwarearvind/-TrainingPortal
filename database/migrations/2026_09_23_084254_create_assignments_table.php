<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('assignments', function (Blueprint $table) {

            $table->id();

            $table->foreignId('course_id')
                ->constrained('courses')
                ->cascadeOnDelete();

            $table->foreignId('batch_id')
                ->constrained('batches')
                ->cascadeOnDelete();

            $table->string('title');

            $table->string('slug')->unique();

            $table->text('description')->nullable();

            $table->text('instructions')->nullable();

            $table->string('attachment')->nullable();

            $table->string('attachment_name')->nullable();

            $table->string('attachment_size')->nullable();

            $table->decimal('total_marks', 8, 2)
                ->default(100);

            $table->dateTime('start_date')->nullable();

            $table->dateTime('due_date')->nullable();

            $table->boolean('allow_late_submission')
                ->default(false);

            $table->decimal('late_penalty', 5, 2)
                ->default(0);

            $table->integer('sort_order')
                ->default(0);

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

            $table->index('due_date');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('assignments');
    }
};
