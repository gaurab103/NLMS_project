<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('teacher', function (Blueprint $table) {
            $table->bigIncrements('id');
            
            $table->string('Name');
            $table->string('Address');
            $table->bigInteger('Contact_no');
            $table->unsignedBigInteger('A_ID');
            $table->string('Email');
            $table->string('Status');
            $table->timestamps();


            $table->foreign('A_ID')
                ->references('id')
                ->on('admin')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('teacher');
    }
};
