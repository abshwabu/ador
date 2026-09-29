<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (Schema::hasTable('settings') && Schema::hasColumn('settings', 'about_check_2_title')) {
            DB::table('settings')
                ->where('about_check_2_title', 'Interior Fitting & Installation')
                ->update(['about_check_2_title' => 'Interior Finishing & Installation']);
        }

        if (Schema::hasTable('services')) {
            DB::table('services')
                ->where('title', 'Interior Fitting & Installation')
                ->update(['title' => 'Interior Finishing & Installation']);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('settings') && Schema::hasColumn('settings', 'about_check_2_title')) {
            DB::table('settings')
                ->where('about_check_2_title', 'Interior Finishing & Installation')
                ->update(['about_check_2_title' => 'Interior Fitting & Installation']);
        }

        if (Schema::hasTable('services')) {
            DB::table('services')
                ->where('title', 'Interior Finishing & Installation')
                ->update(['title' => 'Interior Fitting & Installation']);
        }
    }
};
