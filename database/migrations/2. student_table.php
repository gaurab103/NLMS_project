<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->date('dob');
            $table->string('photo')->nullable();
            $table->string('Address');
            $table->string('Parent_Name');
            $table->string('Contact_No');
            $table->string('Email')->unique();
            $table->unsignedBigInteger('C_ID')->nullable();
            $table->unsignedBigInteger('A_ID')->nullable();
            $table->string('Stats');
            $table->string('Username')->unique();
            $table->string('Password');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('students');
    }
};
