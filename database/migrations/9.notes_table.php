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
            $table->string('title');       // Note title
            $table->text('content');       // Note content
            $table->unsignedBigInteger('subject_id'); // References subjects.id
            $table->unsignedBigInteger('teacher_id')->nullable(); // References teachers.id
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
