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
        Schema::create('companies', function (Blueprint $table) {
            $table->uuid('id')->primary(); // Must be named 'id' for default constrained()
            $table->string('legal_name');
            $table->string('trade_name')->nullable();
            $table->string('registration_number')->unique();
            $table->string('tax_id')->unique();
            $table->date('incorporation_date');
            $table->string('legal_structure');
            $table->string('jurisdiction');
            $table->string('industry');
            $table->boolean('is_active')->default(true);
            $table->text('headquarters_address');
            $table->string('country', 2);
            $table->string('phone');
            $table->string('email');
            $table->string('website')->nullable();
            $table->string('certificate_of_incorporation')->nullable();
            $table->string('tax_registration_certificate')->nullable();
            $table->string('logo')->nullable();
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
        Schema::dropIfExists('companies');
    }
};