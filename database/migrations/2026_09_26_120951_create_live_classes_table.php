<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('live_classes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('course_id');
            $table->string('teacher_name');
            $table->string('title');
            $table->string('platform')->default('Zoom'); // Zoom, Google Meet, Jitsi
            $table->string('meeting_link');
            $table->dateTime('scheduled_at');
            $table->integer('duration_minutes')->default(60);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('live_classes');
    }
};