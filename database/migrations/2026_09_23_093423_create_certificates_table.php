<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('certificates', function (Blueprint $table) {

            $table->id();

            $table->foreignId('student_id')
                ->constrained('students')
                ->cascadeOnDelete();

            $table->foreignId('course_id')
                ->constrained('courses')
                ->cascadeOnDelete();

            $table->foreignId('batch_id')
                ->constrained('batches')
                ->cascadeOnDelete();

            $table->string('certificate_no')
                ->unique();

            $table->string('verification_code')
                ->unique();

            $table->string('certificate_title')
                ->default('Certificate of Completion');

            $table->decimal('marks', 8, 2)
                ->nullable();

            $table->decimal('total_marks', 8, 2)
                ->nullable();

            $table->string('grade')
                ->nullable();

            $table->date('completion_date')
                ->nullable();

            $table->date('issue_date');

            $table->string('certificate_file')
                ->nullable();

            $table->boolean('status')
                ->default(true);

            $table->timestamps();

            $table->index('student_id');
            $table->index('course_id');
            $table->index('batch_id');
            $table->index('verification_code');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('certificates');
    }
};
