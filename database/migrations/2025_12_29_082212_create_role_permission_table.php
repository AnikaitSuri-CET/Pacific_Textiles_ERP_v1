<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('role_permission', function (Blueprint $table) {
            $table->id();                                               // Auto Increment
            
            $table->foreignId('role_id')                                // References roles.id
                  ->constrained('roles')
                  ->onDelete('cascade');
            
            $table->foreignId('premission_id')                          // References permissions.id
                  ->constrained('permissions')
                  ->onDelete('cascade');
            
            $table->timestamp('granted_at')->useCurrent();              // When permission was granted

            $table->foreignId('granted_by')                             // Admin user who granted
                  ->nullable()
                  ->constrained('users')
                  ->nullOnDelete();
            
            $table->timestamps();

            $table->unique(['role_id', 'permission_id']);               // Unique constraint for roles.id and permissions.id
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('role_permission');
    }
};
