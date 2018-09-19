<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLinksTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        if (in_array('menus', config('cms.active-core-modules'))) {
            Schema::create(config('cms.db-prefix', '').'links', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name');
                $table->boolean('external')->default(0);
                $table->integer('page_id');
                $table->integer('menu_id');
                $table->string('external_url')->nullable();
                $table->nullableTimestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        if (in_array('menus', config('cms.active-core-modules'))) {
            Schema::drop(config('cms.db-prefix', '').'links');
        }
    }
}
