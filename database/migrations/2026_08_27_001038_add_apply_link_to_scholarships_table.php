<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('scholarships', function (Blueprint $table) {
            if (!Schema::hasColumn('scholarships', 'amount')) {
                $table->string('amount')->nullable();
            }
            if (!Schema::hasColumn('scholarships', 'provider')) {
                $table->string('provider')->nullable();
            }
            if (!Schema::hasColumn('scholarships', 'category')) {
                $table->string('category')->nullable();
            }
            if (!Schema::hasColumn('scholarships', 'eligibility')) {
                $table->text('eligibility')->nullable();
            }
            if (!Schema::hasColumn('scholarships', 'deadline')) {
                $table->timestamp('deadline')->nullable();
            }
            if (!Schema::hasColumn('scholarships', 'last_date')) {
                $table->timestamp('last_date')->nullable();
            }
        });
    }

    public function down(): void
    {
    }
};