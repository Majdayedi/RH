<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   // New migration file
public function up()
{
    // Forms Table (stores form designs)
    Schema::create('forms', function (Blueprint $table) {
        $table->uuid('id')->primary();
        $table->uuid('company_id');
        $table->string('title');
        $table->text('description')->nullable();
        $table->json('schema'); // Full SurveyJS JSON definition
        $table->uuid('created_by');
        $table->boolean('is_active')->default(true);
        $table->timestamps();
        
        $table->foreign('company_id')->references('id')->on('companies');
        $table->foreign('created_by')->references('id')->on('users');
    });

    // Submissions Table (stores responses)
    Schema::create('submissions', function (Blueprint $table) {
        $table->uuid('id')->primary();
        $table->uuid('form_id');
        $table->uuid('user_id')->comment('Respondent');
        $table->json('data'); // Full response JSON
        $table->enum('status', ['PENDING','APPROVED','REJECTED'])->default('PENDING');
        $table->uuid('reviewed_by')->nullable();
        $table->timestamps();
        
        $table->foreign('form_id')->references('id')->on('forms')->cascadeOnDelete();
        $table->foreign('user_id')->references('id')->on('users');
        $table->foreign('reviewed_by')->references('id')->on('users');
    });

    // Optional: Analytics Cache Table
    Schema::create('form_analytics', function (Blueprint $table) {
        $table->uuid('form_id')->primary();
        $table->integer('submission_count')->default(0);
        $table->json('summary_stats')->nullable();
        $table->timestamp('last_submission_at')->nullable();
        
        $table->foreign('form_id')->references('id')->on('forms')->cascadeOnDelete();
    });
}

public function down()
{
    Schema::dropIfExists('form_analytics');
    Schema::dropIfExists('submissions');
    Schema::dropIfExists('forms');
}
};
