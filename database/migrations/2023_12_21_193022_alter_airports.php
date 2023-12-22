<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('airports', function (Blueprint $table) {
            $table->string('dst')->nullable()->change();
            $table->string('time_zone_type')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('airports', function (Blueprint $table) {
            $table->string('dst')->length(1)->change();
            if (Schema::hasColumn('airports', 'time_zone_type')) {
                $table->dropColumn('time_zone_type');
            }
        });
    }
};
