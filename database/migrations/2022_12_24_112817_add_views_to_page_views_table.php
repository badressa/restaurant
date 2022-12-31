<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddViewsToPageViewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('page_views', function (Blueprint $table) {
            $table->integer('views')->after('id');
            $table->string('page_name')->nullable();
            $table->string('Operating_system')->nullable();
            $table->string('device')->nullable()->comment('tablet phone laptop tv ...');
            $table->string('device_cookie')->nullable();
            $table->string('user_agent')->nullable()->comment('Browser');
            $table->integer('user_id')->nullable();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('page_views', function (Blueprint $table) {
            $table->dropColumn(['views','page_name','Operating_system','device','device_cookie','user_agent','user_id']);
        });
    }
}
