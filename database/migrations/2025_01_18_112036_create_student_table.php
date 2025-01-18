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
        Schema::create('student', function (Blueprint $table) {
            $table->id();
            $table->string('Student_name',191);
            $table->enum('class',['1','2','3','4','5','6','7','8','9','10']);
            $table->string('roll_no',191);
            $table->string('phone_no',191);
            $table->string('email',191);
            $table->text('address',191);
            $table->date('dob');
            $table->enum('gender',['M','F','O']);
            $table->boolean('is_active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student');
    }
};
