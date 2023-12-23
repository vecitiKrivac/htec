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
        Schema::create('airports', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('city_id')->index();
            $table->foreign('city_id')->references('id')->on('cities');
            $table->string('name');
            $table->string('iata', 3)->nullable();
            $table->string('icao', 4)->nullable();
            $table->double('latitude');
            $table->double('longitude');
            $table->integer('altitude');
            $table->tinyInteger('time_zone_utc')->nullable();
            $table->string('dst', 1);
            $table->string('source');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('airports');
    }
};
