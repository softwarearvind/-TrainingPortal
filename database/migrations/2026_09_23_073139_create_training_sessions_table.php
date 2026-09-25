<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('training_sessions', function (Blueprint $table) {

            $table->id();

            $table->foreignId('batch_id')
                ->constrained('batches')
                ->cascadeOnDelete();

            $table->foreignId('trainer_id')
                ->nullable()
                ->constrained('trainers')
                ->nullOnDelete();

            $table->string('title');

            $table->string('session_code')
                ->unique();

            $table->text('topic')->nullable();

            $table->date('session_date');

            $table->time('start_time');

            $table->time('end_time');

            $table->enum('training_mode', [
                'online',
                'offline',
                'hybrid'
            ])->default('online');

            $table->string('room')->nullable();

            $table->string('location')->nullable();

            $table->string('meeting_platform')->nullable();

            $table->string('meeting_link')->nullable();

            $table->string('recording_link')->nullable();

            $table->text('notes')->nullable();

            $table->enum('status', [
                'scheduled',
                'ongoing',
                'completed',
                'cancelled'
            ])->default('scheduled');

            $table->timestamps();

            $table->index([
                'batch_id',
                'session_date'
            ]);

            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('training_sessions');
    }
};
