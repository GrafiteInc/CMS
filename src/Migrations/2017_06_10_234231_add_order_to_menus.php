<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOrderToMenus extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        if (in_array('menus', config('cms.active-core-modules'))) {
            Schema::table(config('cms.db-prefix', '').'menus', function (Blueprint $table) {
                $table->text('order')->nullable();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        if (in_array('menus', config('cms.active-core-modules'))) {
            Schema::table(config('cms.db-prefix', '').'menus', function ($table) {
                $table->dropColumn('order');
            });
        }
    }
}
