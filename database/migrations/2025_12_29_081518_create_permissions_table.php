<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('permissions', function (Blueprint $table) {
            $table->id();                                               // Auto Increment
            $table->string('permission_name');                          // Human readable name
            $table->string('key')->unique();                            // Machine readable permission
            $table->string('module');                                   // Logical grouping
            $table->text('description')->nullable();                    // What this permission allows
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('permissions');
    }
};
