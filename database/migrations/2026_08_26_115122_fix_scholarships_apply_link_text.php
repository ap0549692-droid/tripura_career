<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(){
        if (DB::getDriverName() === 'sqlite') {
            return;
        }
        try { DB::statement('ALTER TABLE scholarships MODIFY apply_link TEXT'); } catch(\Exception $e){}
    }
    public function down(){}
};
