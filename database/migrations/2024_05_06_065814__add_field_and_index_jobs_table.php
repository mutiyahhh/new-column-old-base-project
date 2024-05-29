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
        if (!Schema::hasColumn('jobs', 'status_approval')) {
            Schema::table('jobs', function (Blueprint $table) {
                // add enum for type process approval (this works when version laravel on 10+
                $table->enum('status_approval', ['processed', 'approved', 'not_approved'])->nullable(true)->after('cabang_id');
            });
        }

        Schema::table('jobs', function (Blueprint $table) {
            $schemaManager = Schema::getConnection()->getDoctrineSchemaManager();
            $indexesFound  = $schemaManager->listTableIndexes('jobs');
            $table->foreign('level_id')->references('id')->on('levels')->onDelete('cascade');
            $table->foreign('cabang_id')->references('id')->on('cabangs')->onDelete('cascade');

//            if ($schemaManager->listTableDetails('jobs')->hasForeignKey('level_id')){
//                $table->foreign('level_id')->references('id')->on('levels')->onDelete('cascade');
//            }
//            if($schemaManager->listTableDetails('jobs')->hasForeignKey('cabang_id')){
//                $table->foreign('cabang_id')->references('id')->on('cabangs')->onDelete('cascade');
//            }
            if (! array_key_exists('jobs_level_id_index', $indexesFound)) {
                $table->index('level_id', 'jobs_level_id_index');
            }
            if (! array_key_exists('jobs_cabang_id_index', $indexesFound)) {
                $table->index('cabang_id', 'jobs_cabang_id_index');
            }
            if (! array_key_exists('jobs_status_approval_index', $indexesFound)) {
                $table->index('status_approval', 'jobs_status_approval_index');
            }
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('jobs', function (Blueprint $table) {
            $table->dropForeign(['level_id']);
            $table->dropForeign(['cabang_id']);
            $table->dropIndex(['level_id']);
            $table->dropIndex(['cabang_id']);
            $table->dropIndex(['status_approval']);
            $table->dropColumn(['status_approval']);
        });
    }
};
