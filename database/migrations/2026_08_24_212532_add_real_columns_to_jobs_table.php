<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('jobs', function (Blueprint $table) {
            if(!Schema::hasColumn('jobs','sector')) $table->string('sector')->nullable()->after('title');
            if(!Schema::hasColumn('jobs','post_name')) $table->string('post_name')->nullable();
            if(!Schema::hasColumn('jobs','total_vacancy')) $table->integer('total_vacancy')->nullable();
            if(!Schema::hasColumn('jobs','salary_min')) $table->string('salary_min')->nullable();
            if(!Schema::hasColumn('jobs','salary_max')) $table->string('salary_max')->nullable();
            if(!Schema::hasColumn('jobs','level')) $table->string('level')->nullable();
            if(!Schema::hasColumn('jobs','job_location')) $table->string('job_location')->default('Tripura');
            if(!Schema::hasColumn('jobs','official_notification')) $table->text('official_notification')->nullable();
            if(!Schema::hasColumn('jobs','source_website')) $table->string('source_website')->nullable();
            if(!Schema::hasColumn('jobs','description')) $table->text('description')->nullable();
        });
    }
    public function down(): void {}
};