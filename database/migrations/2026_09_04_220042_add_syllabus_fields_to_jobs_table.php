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
    Schema::table('jobs', function (Blueprint $table) {
        if (!Schema::hasColumn('jobs', 'syllabus_link')) {
            $table->string('syllabus_link')->nullable()->after('pdf_link');
        }
        if (!Schema::hasColumn('jobs', 'pyq_link')) {
            $table->string('pyq_link')->nullable()->after('syllabus_link');
        }
        if (!Schema::hasColumn('jobs', 'min_age')) {
            $table->integer('min_age')->default(18)->after('qualification');
        }
        if (!Schema::hasColumn('jobs', 'max_age')) {
            $table->integer('max_age')->default(40)->after('min_age');
        }
        if (!Schema::hasColumn('jobs', 'documents')) {
            $table->string('documents')->nullable()->after('max_age');
        }
        if (!Schema::hasColumn('jobs', 'prtc_required')) {
            $table->boolean('prtc_required')->default(1)->after('documents');
        }
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
