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
        Schema::create('notes', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->string('file_path')->nullable();
            $table->string('title');
            $table->string('chapter_name')->nullable();
            $table->text('content');
            $table->unsignedBigInteger('subject_id');
            $table->unsignedBigInteger('teacher_id')->nullable();
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('subject_id')
                  ->references('id')
                  ->on('subjects')
                  ->onDelete('cascade');

            $table->foreign('teacher_id')
                  ->references('id')
                  ->on('teachers')
                  ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notes');
    }
};
