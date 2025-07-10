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
        Schema::create('submissions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('form_id');
            $table->uuid('submitted_by');
            $table->enum('status', ['PENDING', 'APPROVED', 'REJECTED'])->default('PENDING');
            $table->uuid('reviewed_by')->nullable();
            $table->timestamp('submitted_at')->useCurrent();
            $table->timestamps();
        
            $table->foreign('form_id')->references('id')->on('forms');
            $table->foreign('submitted_by')->references('id')->on('users');
            $table->foreign('reviewed_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('submissions');
    }
};
