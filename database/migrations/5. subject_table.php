<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('subject', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('T_ID');
            $table->unsignedBigInteger('A_ID');
            $table->string('Subject_Name');
            $table->timestamps();

            $table->foreign('T_ID')->references('id')->on('teachers')->onDelete('cascade');

            $table->foreign('A_ID')
                ->references('id')
                ->on('admin')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('subject');
    }
};
