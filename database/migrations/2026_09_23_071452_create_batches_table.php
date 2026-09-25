<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('batches', function (Blueprint $table) {
            $table->id();

            $table->foreignId('course_id')
                ->constrained('courses')
                ->cascadeOnDelete();

            $table->foreignId('trainer_id')
                ->nullable()
                ->constrained('trainers')
                ->nullOnDelete();

            $table->string('name');

            $table->string('batch_code')->unique();

            $table->date('start_date');

            $table->date('end_date')->nullable();

            $table->time('start_time')->nullable();

            $table->time('end_time')->nullable();

            $table->enum('training_mode', [
                'online',
                'offline',
                'hybrid'
            ])->default('online');

            $table->unsignedInteger('capacity')->default(30);

            $table->string('room')->nullable();

            $table->string('meeting_link')->nullable();

            $table->text('description')->nullable();

            $table->enum('status', [
                'upcoming',
                'ongoing',
                'completed',
                'cancelled'
            ])->default('upcoming');

            $table->timestamps();

            $table->index([
                'course_id',
                'trainer_id'
            ]);

            $table->index('start_date');
            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('batches');
    }
};
