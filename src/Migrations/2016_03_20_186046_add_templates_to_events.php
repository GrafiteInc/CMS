<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddTemplatesToEvents extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        if (in_array('events', config('cms.active-core-modules'))) {
            Schema::table(config('cms.db-prefix', '').'events', function (Blueprint $table) {
                $table->string('template')->default('show');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        if (in_array('events', config('cms.active-core-modules'))) {
            Schema::table(config('cms.db-prefix', '').'events', function ($table) {
                $table->dropColumn('template');
            });
        }
    }
}
