<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(){
        // SQLite pe MODIFY fail hota hai, isliye safe tarika
        if (DB::getDriverName() === 'sqlite') {
            // SQLite me TEXT pehle se hi flexible hai, kuch karne ki zarurat nahi
            return;
        }

        // MySQL ke liye
        try { DB::statement('ALTER TABLE jobs MODIFY apply_link TEXT'); } catch(\Exception $e){}
        try { DB::statement('ALTER TABLE jobs MODIFY pdf_url TEXT'); } catch(\Exception $e){}
        try { DB::statement('ALTER TABLE jobs MODIFY official_website TEXT'); } catch(\Exception $e){}
        try { Schema::table('jobs', function (Blueprint $table) { $table->text('description')->change(); }); } catch(\Exception $e){}
    }
    public function down(){}
};
