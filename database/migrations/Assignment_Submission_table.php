<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('assignment_submissions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('assignment_id');
            $table->foreign('assignment_id')
                  ->references('id')
                  ->on('assignments')
                  ->onDelete('cascade');

            $table->foreignId('student_id')
                  ->constrained()
                  ->onDelete('cascade');

            $table->string('file_path')->nullable();
            $table->integer('marks_obtained')->nullable();
            $table->timestamp('submitted_at');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('assignment_submissions');
    }
};
