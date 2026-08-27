<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
return new class extends Migration {
    public function up(){
        DB::statement('ALTER TABLE jobs ADD COLUMN admit_card_link TEXT NULL AFTER apply_link');
        DB::statement('ALTER TABLE jobs ADD COLUMN result_link TEXT NULL AFTER admit_card_link');
        DB::statement('ALTER TABLE jobs ADD COLUMN admit_card_date DATE NULL');
        DB::statement('ALTER TABLE jobs ADD COLUMN result_date DATE NULL');
    }
    public function down(){}
};