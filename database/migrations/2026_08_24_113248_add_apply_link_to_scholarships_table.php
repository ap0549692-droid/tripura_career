<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('scholarships', function (Blueprint $table) {
            if (!Schema::hasColumn('scholarships', 'apply_link')) {
                $table->string('apply_link')->nullable()->after('description');
            }
            if (!Schema::hasColumn('scholarships', 'last_date')) {
                $table->date('last_date')->nullable()->after('apply_link');
            }
            if (!Schema::hasColumn('scholarships', 'deadline')) {
                $table->date('deadline')->nullable()->after('last_date');
            }
            if (!Schema::hasColumn('scholarships', 'amount')) {
                $table->string('amount')->nullable()->after('provider');
            }
            if (!Schema::hasColumn('scholarships', 'category')) {
                $table->string('category')->nullable();
            }
        });
    }
    public function down(): void {
        Schema::table('scholarships', function (Blueprint $table) {
            $table->dropColumn(['apply_link','last_date','deadline']);
        });
    }
};*