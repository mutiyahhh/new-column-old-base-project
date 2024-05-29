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
        if (!Schema::hasColumn('review_jobs', 'job_id')) {
            Schema::table('review_jobs', function (Blueprint $table) {
                $table->unsignedBigInteger('job_id')->nullable()->change();
            });
        }
        if (!Schema::hasColumn('review_jobs', 'related_job_id')) {
            Schema::table('review_jobs', function (Blueprint $table) {
                $table->unsignedBigInteger('related_job_id')->nullable()->after('user_id');
                $table->index(['related_job_id']);
                $table->foreign('related_job_id')->references('id')->on('related_jobs')->onDelete('cascade');
            });
        }

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('review_jobs', function (Blueprint $table) {
            $table->unsignedBigInteger('job_id')->nullable(true)->change();
            $table->dropForeign(['related_job_id']);
            $table->dropColumn('related_job_id');
        });
    }
};
