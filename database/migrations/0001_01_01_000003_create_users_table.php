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
        Schema::create('users', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('matricule')->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->enum('role', ['employee', 'hr_staff', 'hr_admin', 'manager']);
            $table->string('first_name');
            $table->foreignUuid('company_id')->constrained()->onDelete('cascade');
            $table->string('department');
            $table->string('hr_role')->nullable();
            $table->boolean('is_active')->default(true);
            $table->rememberToken();
            $table->timestamps();
            
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};