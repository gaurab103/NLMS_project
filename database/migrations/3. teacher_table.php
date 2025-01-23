<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('teachers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('A_ID')->nullable();
            $table->string('Teacher_Name');
            $table->string('Address');
            $table->string('Subject');
            $table->bigInteger('Phone_Number');
            $table->string('Email');
            $table->boolean('Status');
            $table->string('Username', 191);
            $table->string('Password', 255);
            $table->timestamps();

            $table->foreign('A_ID')
                ->references('id')
                ->on('admin')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('teachers');
    }
};
