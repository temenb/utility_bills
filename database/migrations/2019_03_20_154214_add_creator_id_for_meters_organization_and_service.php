<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCreatorIdForMetersOrganizationAndService extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('organizations', function (Blueprint $table) {
            $table->integer('creator')->unsigned()->after('id');
        });

        Schema::table('services', function (Blueprint $table) {
            $table->integer('creator')->unsigned()->after('id');
        });

        Schema::table('meters', function (Blueprint $table) {
            $table->integer('creator')->unsigned()->after('id');
        });

        Schema::table('meter_values', function (Blueprint $table) {
            $table->integer('creator')->unsigned()->after('id');
        });

        Schema::table('accounts', function (Blueprint $table) {
            $table->integer('creator')->unsigned()->after('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('organizations', function (Blueprint $table) {
            $table->dropColumn('creator');
        });

        Schema::table('services', function (Blueprint $table) {
            $table->dropColumn('creator');
        });

        Schema::table('meters', function (Blueprint $table) {
            $table->dropColumn('creator');
        });

        Schema::table('meter_values', function (Blueprint $table) {
            $table->dropColumn('creator');
        });

        Schema::table('accounts', function (Blueprint $table) {
            $table->dropColumn('creator');
        });
    }
}
