<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   // In the generated migration file
public function up()
{
    Schema::dropIfExists('answers');
    Schema::dropIfExists('submissions');
    Schema::dropIfExists('questions');
    Schema::dropIfExists('forms');
}

public function down()
{
    // Not recommended to recreate old structure
    // Leave empty or implement if absolutely needed
}
};
