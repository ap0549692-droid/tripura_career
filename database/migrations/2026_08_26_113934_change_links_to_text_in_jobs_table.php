<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(){
        // Sirf jo column exist karta hai usko TEXT banao
        DB::statement('ALTER TABLE jobs MODIFY apply_link TEXT');
        
        // Agar ye columns hain to hi change karo, nahi to ignore
        try { DB::statement('ALTER TABLE jobs MODIFY pdf_url TEXT'); } catch(\Exception $e){}
        try { DB::statement('ALTER TABLE jobs MODIFY official_website TEXT'); } catch(\Exception $e){}
        try { Schema::table('jobs', function (Blueprint $table) { $table->text('description')->change(); }); } catch(\Exception $e){}
    }
    public function down(){}
};