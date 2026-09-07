<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(){
  Schema::table('jobs', function($table){
    $table->integer('min_age')->default(18);
    $table->integer('max_age')->default(40);
    $table->string('required_qualification')->default('10th Pass');
    $table->boolean('prtc_required')->default(true);
    $table->string('syllabus_link')->nullable();
    $table->string('pyq_link')->nullable();
    $table->text('documents')->nullable(); // comma separated
  });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('jobs', function (Blueprint $table) {
            //
        });
    }
};
