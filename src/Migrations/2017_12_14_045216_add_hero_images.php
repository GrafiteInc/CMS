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
        Schema::table(config('cms.db-prefix', '').'blogs', function (Blueprint $table) {
            $table->string('hero_image')->nullable();
        });

        Schema::table(config('cms.db-prefix', '').'pages', function (Blueprint $table) {
            $table->string('hero_image')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table(config('cms.db-prefix', '').'blogs', function ($table) {
            $table->dropColumn('hero_image');
        });

        Schema::table(config('cms.db-prefix', '').'pages', function ($table) {
            $table->dropColumn('hero_image');
        });
    }
}
