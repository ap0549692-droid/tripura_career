<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(){
        DB::statement('ALTER TABLE scholarships MODIFY apply_link TEXT');
        try { DB::statement('ALTER TABLE scholarships MODIFY official_link TEXT'); } catch(\Exception $e) {}
    }
    public function down(){}
};