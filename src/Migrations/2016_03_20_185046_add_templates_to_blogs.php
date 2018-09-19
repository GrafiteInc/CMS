<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddTemplatesToBlogs extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        if (in_array('blog', config('cms.active-core-modules'))) {
            Schema::table(config('cms.db-prefix', '').'blogs', function (Blueprint $table) {
                $table->string('template')->default('show');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        if (in_array('blog', config('cms.active-core-modules'))) {
            Schema::table(config('cms.db-prefix', '').'blogs', function ($table) {
                $table->dropColumn('template');
            });
        }
    }
}
