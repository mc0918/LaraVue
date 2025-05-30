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
        Schema::create('countries', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedInteger('country_list_id');
            $table->foreign('country_list_id')->references('id')->on('country_lists');

            $table->string('name');
            $table->string('capital');
            $table->string('languages');
            $table->boolean('landlocked');
            $table->integer('population');
            $table->string('region');
            $table->string('subregion');
            $table->string('flag')->nullable();
            $table->string('coatOfArms')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Commented out for idempotent migrations
//        Schema::dropIfExists('countries');
    }
};
