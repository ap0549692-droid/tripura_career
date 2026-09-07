<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jobs', function (Blueprint $table) {

            $table->id();

            $table->string('title');

            $table->string('department');

            $table->string('location')->nullable();

            $table->string('qualification')->nullable();

            $table->string('category')->nullable();

            $table->date('last_date');

            $table->string('apply_link', 500);

            // PDF file path
            $table->string('pdf_link')->nullable();

            $table->longText('description')->nullable();

            // Job image path
            $table->string('image')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jobs');
    }
};