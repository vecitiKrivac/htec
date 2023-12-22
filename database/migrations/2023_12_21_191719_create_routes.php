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
        Schema::create('routes', function (Blueprint $table) {
            $table->id();
            $table->integer('airline_id');
            $table->string('airline', 3);
            $table->unsignedBigInteger('source_airport_id')->unsigned()->index();
            $table->unsignedBigInteger('destination_airport_id')->unsigned()->index();
            $table->string('codeshare', 1);
            $table->tinyInteger('stops');
            $table->string('equipment', 3);
            $table->float('price')->unsigned();
            $table->timestamps();

            $table->foreign('source_airport_id')->references('id')->on('airports');
            $table->foreign('destination_airport_id')->references('id')->on('airports');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('routes');
    }
};
