<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('jobs', function (Blueprint $table) {
            if (!Schema::hasColumn('jobs', 'apply_link')) {
                $table->string('apply_link', 500)->nullable()->after('deadline');
            }
            if (!Schema::hasColumn('jobs', 'department')) {
                $table->string('department')->nullable()->after('title');
            }
        });
    }
    public function down()
    {
        Schema::table('jobs', function (Blueprint $table) {
            $table->dropColumn(['apply_link', 'department']);
        });
    }
};