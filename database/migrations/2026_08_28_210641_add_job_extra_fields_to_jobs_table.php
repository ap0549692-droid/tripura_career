<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('jobs', function (Blueprint $table) {

            if (!Schema::hasColumn('jobs', 'location')) {
                $table->string('location')->nullable()->after('department');
            }

            if (!Schema::hasColumn('jobs', 'description')) {
                $table->text('description')->nullable()->after('pdf_link');
            }

            if (!Schema::hasColumn('jobs', 'image')) {
                $table->string('image')->nullable()->after('description');
            }
        });
    }

    public function down(): void
    {
        Schema::table('jobs', function (Blueprint $table) {

            if (Schema::hasColumn('jobs', 'location')) {
                $table->dropColumn('location');
            }

            if (Schema::hasColumn('jobs', 'description')) {
                $table->dropColumn('description');
            }

            if (Schema::hasColumn('jobs', 'image')) {
                $table->dropColumn('image');
            }
        });
    }
};