<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('C_ID'); 
            $table->unsignedBigInteger('A_ID');
            $table->timestamps();

            $table->foreign('C_ID')
                ->references('id')
                ->on('courses')
                ->onDelete('cascade');

                $table->foreign('A_ID')
                ->references('id')
                ->on('admin')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};

