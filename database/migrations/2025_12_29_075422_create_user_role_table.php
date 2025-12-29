<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user_role', function (Blueprint $table) {
            $table->id();                                                  // Auto Increment
            
            $table->foreignId('user_id')                                   // References users.id
                  ->constrained('users')
                  ->onDelete('cascade');

            $table->foreignId('role_id')                                   // References roles.id
                  ->constrained('roles')
                  ->onDelete('cascade');

            $table->timestamp('assigned_at')->useCurrent();                // When role was granted

            $table->foreignId('assigned_by')                               // Admin user who assigned
                  ->nullable()
                  ->constrained('users')
                  -nullOnDelete();
            
            $table->timestamps();

            $table->unique(['user_id', 'role_id']);                        // Unique constraint for users.id and roles.id
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_role');
    }
};
