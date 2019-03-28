<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Models\Entities\Meter;

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
            $table->bigInteger('owner_id')->unsigned()->nullable()->default(null)
                ->references('id')->on('users');
            $table->boolean('enabled')->default(true);
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('services', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->unsignedInteger('organization_id')->references('id')->on('organizations');
            $table->bigInteger('owner_id')->unsigned()->nullable()->default(null)
                ->references('id')->on('users');
            $table->boolean('enabled')->default(true);
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('meters', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->unsignedInteger('service_id')->references('id')->on('services');
            $table->enum('type', Meter::enumType());
            $table->json('disabled_months')->nullable();
            $table->unsignedInteger('rate');
            $table->bigInteger('owner_id')->unsigned()->nullable()->default(null)
                ->references('id')->on('users');
            $table->boolean('enabled')->default(true);
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('meter_values', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('meter_id')->references('id')->on('meter');
            $table->unsignedInteger('value');
            $table->bigInteger('owner_id')->unsigned()->nullable()->default(null)
                ->references('id')->on('users');
            $table->boolean('enabled')->default(true);
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('accounts', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('organization_id')->references('id')->on('organizations');
            $table->unsignedInteger('value')->nullable();
            $table->unsignedInteger('payment')->nullable();
            $table->bigInteger('owner_id')->unsigned()->nullable()->default(null)
                ->references('id')->on('users');
            $table->boolean('enabled')->default(true);
            $table->softDeletes();
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
        Schema::dropIfExists('meter_values');
        Schema::dropIfExists('meters');
        Schema::dropIfExists('services');
        Schema::dropIfExists('organizations');
    }
}
