<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('jobs', function (Blueprint $table) {
            if (!Schema::hasColumn('jobs', 'image')) {
                $table->string('image')->nullable()->after('apply_link');
            }
            if (!Schema::hasColumn('jobs', 'pdf_link')) {
                $table->string('pdf_link', 500)->nullable()->after('image');
            }
            if (!Schema::hasColumn('jobs', 'department')) {
                $table->string('department')->nullable()->after('title');
            }
            if (!Schema::hasColumn('jobs', 'qualification')) {
                $table->string('qualification')->nullable()->after('department');
            }
            if (!Schema::hasColumn('jobs', 'last_date')) {
                $table->date('last_date')->nullable()->after('qualification');
            }
            if (!Schema::hasColumn('jobs', 'apply_link')) {
                $table->string('apply_link', 500)->nullable()->after('last_date');
            }
        });
    }

    public function down(): void
    {
        Schema::table('jobs', function (Blueprint $table) {
            $table->dropColumn(['image', 'pdf_link']);
        });
    }
};