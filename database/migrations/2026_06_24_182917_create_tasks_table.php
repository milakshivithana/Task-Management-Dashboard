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
    Schema::create('tasks', function (Blueprint $table) {
        $table->id();
        $table->string('title'); // Task Title eka 
        $table->text('description')->nullable(); // Description eka, meka nathuwath save karanna puluwan (nullable) 
        $table->enum('status', ['Pending', 'In Progress', 'Completed'])->default('Pending'); // Status eka 
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
