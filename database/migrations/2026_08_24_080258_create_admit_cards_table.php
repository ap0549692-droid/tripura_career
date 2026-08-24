<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
  Schema::create('admit_cards', function (Blueprint $table) {
    $table->id();
    $table->string('title');
    $table->string('department');
    $table->string('exam_date')->nullable();
    $table->string('admit_link');
    $table->text('description')->nullable();
    $table->timestamps();
  });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admit_cards');
    }
};
