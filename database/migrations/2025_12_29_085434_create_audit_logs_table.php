<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('audit_logs', function (Blueprint $table) {
            $table->id();                                                       // Auto Increment

            $table->foreignId(user_id)                                          // Who performed action
                  ->nullable()
                  ->constrained('users')
                  ->nullOnDelete();
            
            $table->string('action');                                           // create / update / delete / approve
            $table->string('entity_type');                                      // Table or module name
            $table->unsignedBigInteger('entity_id')->nullable();                // Record ID

            $table->json('old_values')->nullable();                             // Previous state
            $table->json('new_values')->nullable();                             // Updated state

            $table->string('ip_address')->nullable();                           // User IP
            $table->text('user_agent')->nullable();                             // Browser/device

            $table->text('remarks')->nullable();                                // Remarks

            $table->timestamp('created_at')->useCurrent();                      // No need for 'updated_at', as reports are immutable

            $table->index(['entity_type', 'entity_id']);
            $table->index('action');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('audit_logs');
    }
};
