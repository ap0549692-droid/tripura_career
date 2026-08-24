<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('applications', function (Blueprint $table) {
    $table->id();
    $table->unsignedBigInteger('user_id')->nullable();
    $table->unsignedBigInteger('scholarship_id')->nullable();
    $table->string('scholarship_name')->nullable();
    $table->string('name');
    $table->string('email');
    $table->string('phone')->nullable();
    $table->string('status')->default('pending');
    $table->string('document_path')->nullable();
    $table->timestamps();
});
    }
    public function down(): void {
        Schema::dropIfExists('applications');
    }
};