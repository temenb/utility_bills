<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBaseTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organizations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('services', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->unsignedInteger('value');
            $table->unsignedInteger('organization_id')->references('id')->on('organizations');
            $table->timestamps();
        });

        Schema::create('meters', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('service_id')->references('id')->on('services');
            $table->enum('type', ['fixed', 'not_fixed']);
            $table->json('disabled_months')->nullable();
            $table->unsignedInteger('value');
            $table->timestamps();
        });

        Schema::create('meter_values', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('meter_id')->references('id')->on('meter');
            $table->unsignedInteger('value');
            $table->timestamps();
        });

        Schema::create('accounts', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('organization_id')->references('id')->on('organizations');
            $table->unsignedInteger('value')->nullable();
            $table->unsignedInteger('payment')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('accounts');
        Schema::dropIfExists('meters');
        Schema::dropIfExists('services');
        Schema::dropIfExists('organizations');
        Schema::dropIfExists('meter_values');
    }
}
