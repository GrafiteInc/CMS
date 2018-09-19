<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddBlocks extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        if (in_array('pages', config('cms.active-core-modules'))) {
            Schema::table(config('cms.db-prefix', '').'pages', function (Blueprint $table) {
                $table->text('blocks')->nullable();
            });
        }

        if (in_array('blog', config('cms.active-core-modules'))) {
            Schema::table(config('cms.db-prefix', '').'blogs', function (Blueprint $table) {
                $table->text('blocks')->nullable();
            });
        }

        if (in_array('events', config('cms.active-core-modules'))) {
            Schema::table(config('cms.db-prefix', '').'events', function (Blueprint $table) {
                $table->text('blocks')->nullable();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        if (in_array('pages', config('cms.active-core-modules'))) {
            Schema::table(config('cms.db-prefix', '').'pages', function ($table) {
                $table->dropColumn('blocks');
            });
        }

        if (in_array('blog', config('cms.active-core-modules'))) {
            Schema::table(config('cms.db-prefix', '').'blogs', function ($table) {
                $table->dropColumn('blocks');
            });
        }

        if (in_array('events', config('cms.active-core-modules'))) {
            Schema::table(config('cms.db-prefix', '').'events', function ($table) {
                $table->dropColumn('blocks');
            });
        }
    }
}
