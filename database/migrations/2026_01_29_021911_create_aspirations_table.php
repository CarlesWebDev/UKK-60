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
        Schema::create('aspirations', function (Blueprint $table) {
            $table->id();
            $table->ForeignId('student_id')->constrained('students')->onDelete('cascade');
            $table->ForeignId('category_id')->constrained('categories')->onDelete('cascade');
            $table->ForeignId('feedback_id')->nullable()->constrained('feedback')->onDelete('set null');
            $table->string('title');
            $table->string('description');
            $table->string('photo')->nullable();
            $table->string('location');
            $table->enum('status', ['pending', 'progress', 'completed','rejected', 'archived'])->default('pending');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aspirations');
    }
};
