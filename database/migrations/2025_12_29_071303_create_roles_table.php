<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();                                  // Auto increment
            $table->string('role_name', 100);              // Human readable role-name
            $table->string('slug', 50)->unique();          // System usable unique identifier
            $table->text('description')->nullable();       // Explains responsibility
            $table->boolean('is_active')->default(true);   // Role availability toggle
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('roles');
    }
};
