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
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->string('tugas');
            $table->longText('detail_tugas');
            $table->string('type');
            $table->unsignedBigInteger('level_id'); // Foreign key to levels table
            $table->string('file_laporan')->nullable();
            $table->string('image')->nullable();
            $table->unsignedBigInteger('cabang_id'); // Foreign key to cabangs table
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobs');
    }
};
