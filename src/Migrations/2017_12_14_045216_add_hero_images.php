<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddHeroImages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (in_array('blog', config('cms.active-core-modules'))) {
            Schema::table(config('cms.db-prefix', '').'blogs', function (Blueprint $table) {
                $table->string('hero_image')->nullable();
            });
        }

        if (in_array('pages', config('cms.active-core-modules'))) {
            Schema::table(config('cms.db-prefix', '').'pages', function (Blueprint $table) {
                $table->string('hero_image')->nullable();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (in_array('blog', config('cms.active-core-modules'))) {
            Schema::table(config('cms.db-prefix', '').'blogs', function ($table) {
                $table->dropColumn('hero_image');
            });
        }

        if (in_array('pages', config('cms.active-core-modules'))) {
            Schema::table(config('cms.db-prefix', '').'pages', function ($table) {
                $table->dropColumn('hero_image');
            });
        }
    }
}
