<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('A_ID')->nullable();
            $table->string('Teacher_Name');
            $table->string('Subject');
            $table->string('Email')->unique();
            $table->string('Phone_Number');
            $table->string('Address');
            $table->boolean('Status');
            $table->string('Photo')->nullable();
            $table->string('Username')->unique();
            $table->string('Password');
            $table->timestamps();

            $table->foreign('A_ID')->references('id')->on('admins')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('teachers');
    }
};
