<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        if (DB::getDriverName() === 'sqlite') {
            Schema::table('jobs', function (Blueprint $table) {
                if (!Schema::hasColumn('jobs', 'admit_card_link')) {
                    $table->text('admit_card_link')->nullable();
                }
                if (!Schema::hasColumn('jobs', 'result_link')) {
                    $table->text('result_link')->nullable();
                }
            });
            return;
        }

        Schema::table('jobs', function (Blueprint $table) {
            if (!Schema::hasColumn('jobs', 'admit_card_link')) {
                $table->text('admit_card_link')->nullable()->after('apply_link');
            }
            if (!Schema::hasColumn('jobs', 'result_link')) {
                $table->text('result_link')->nullable()->after('admit_card_link');
            }
        });
    }
    public function down(): void
    {
        Schema::table('jobs', function (Blueprint $table) {
            $table->dropColumn(['admit_card_link', 'result_link']);
        });
    }
};
