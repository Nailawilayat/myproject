<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pricings', function (Blueprint $table) {
            $table->id();

            $table->string('plan_name');
            $table->integer('days_per_week');
            $table->string('days_per_week_text')->nullable();
            $table->integer('free_trial_days')->default(0);
            $table->integer('minutes_per_day');
            $table->string('age_gender')->nullable();
            $table->string('support')->nullable();
            $table->string('class_type')->nullable();
            $table->integer('sort_order')->default(0);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pricings');
    }
};