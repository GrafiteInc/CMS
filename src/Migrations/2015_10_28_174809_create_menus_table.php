<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        if (in_array('menus', config('cms.active-core-modules'))) {
            Schema::create(config('cms.db-prefix', '').'menus', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name');
                $table->string('slug');
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
            Schema::drop(config('cms.db-prefix', '').'menus');
        }
    }
}
