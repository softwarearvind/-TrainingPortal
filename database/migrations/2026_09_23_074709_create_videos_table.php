<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('videos', function (Blueprint $table) {

            $table->id();

            $table->foreignId('course_id')
                ->constrained('courses')
                ->cascadeOnDelete();

            $table->foreignId('training_session_id')
                ->nullable()
                ->constrained('training_sessions')
                ->nullOnDelete();

            $table->string('title');

            $table->string('slug')->unique();

            $table->text('description')->nullable();

            $table->enum('video_type', [
                'youtube',
                'vimeo',
                'external',
                'upload'
            ])->default('youtube');

            $table->string('video_url')->nullable();

            $table->string('video_file')->nullable();

            $table->string('thumbnail')->nullable();

            $table->string('duration')->nullable();

            $table->integer('sort_order')->default(0);

            $table->boolean('status')->default(true);

            $table->timestamps();

            $table->index([
                'course_id',
                'status'
            ]);

            $table->index('training_session_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('videos');
    }
};
