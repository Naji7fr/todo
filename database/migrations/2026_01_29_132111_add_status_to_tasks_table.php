<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->string('status', 20)->default('todo')->after('description');
        });
        DB::table('tasks')->where('is_done', true)->update(['status' => 'done']);
        Schema::table('tasks', function (Blueprint $table) {
            $table->dropColumn('is_done');
        });
    }

    public function down(): void
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->boolean('is_done')->default(false)->after('description');
        });
        DB::table('tasks')->where('status', 'done')->update(['is_done' => true]);
        Schema::table('tasks', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};
