<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
       Schema::create('scholarships', function (Blueprint $table) {
    $table->id();
    $table->string('title');
    $table->string('provider')->nullable();
    $table->text('description')->nullable();
    $table->string('amount')->nullable();
    $table->string('category')->nullable();
    $table->string('eligibility')->nullable();
    $table->date('deadline')->nullable();
    $table->date('last_date')->nullable();
    $table->timestamps();
});
    }
    public function down(): void {
        Schema::dropIfExists('scholarships');
    }
};