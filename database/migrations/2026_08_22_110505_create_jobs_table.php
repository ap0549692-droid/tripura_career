<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up() {
    Schema::create('jobs', function (Blueprint $table) {
        $table->id();
        $table->string('title'); // Ex: TPSC JE 2026
        $table->string('department'); // TPSC, TRBT, Police
        $table->string('qualification');
        $table->date('last_date');
        $table->string('apply_link');
        $table->string('pdf_link')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobs');
    }
};
