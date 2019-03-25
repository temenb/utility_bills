<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterUserWithSoftDelete extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->bigInteger('owner_id')->unsigned()->nullable()->default(null)
                ->references('id')->on('users')->after('remember_token');
            $table->boolean('enabled')->default(true)->after('owner_id');
            $table->softDeletes()->after('enabled');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('owner_id');
            $table->dropColumn('enabled');
            $table->dropSoftDeletes();
        });
    }
}
