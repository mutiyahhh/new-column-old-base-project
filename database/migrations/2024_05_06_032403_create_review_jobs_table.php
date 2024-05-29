<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Schema::hasTable('review_jobs')) {
            Schema::create('review_jobs', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('job_id'); // Foreign key to jobs table
                $table->unsignedBigInteger('user_id'); // Foreign key to jobs table
                $table->unsignedTinyInteger('status_review')->default(0);
                $table->timestamps();
                $table->index(['job_id', 'user_id']);
                $table->foreign('job_id')->references('id')->on('jobs')->noActionOnDelete();
                $table->foreign('user_id')->references('id')->on('users')->noActionOnDelete();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('review_jobs');
    }
};
