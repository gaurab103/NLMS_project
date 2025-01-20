<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->foreignId('A_ID')->constrained('admin')->onDelete('cascade'); // Foreign key
            $table->string('title');
            $table->text('content'); // Changed from string to text
            $table->timestamps(); // Added timestamps
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('news');
    }
};
