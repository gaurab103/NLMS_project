<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('attendances', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->unsignedBigInteger('Std_ID');
            $table->unsignedBigInteger('A_ID');
            $table->unsignedBigInteger('T_ID');
            $table->timestamps();
            $table->string('status');

            $table->foreign('Std_ID')
                ->references('id')
                ->on('students')
                ->onDelete('cascade');

            $table->foreign('A_ID')
                ->references('id')
                ->on('admin')
                ->onDelete('cascade');
            
            $table->foreign('T_ID')
                ->references('id')
                ->on('teacher')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};
