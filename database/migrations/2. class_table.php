<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id(); 
            $table->string('course_name');
            $table->unsignedBigInteger('A_ID');
            $table->timestamps();

            $table->foreign('A_ID')
                ->references('id')
                ->on('admin')
                ->onDelete('cascade');

            
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};

