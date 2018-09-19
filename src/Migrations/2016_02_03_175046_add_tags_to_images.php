<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddTagsToImages extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        if (in_array('images', config('cms.active-core-modules'))) {
            Schema::table(config('cms.db-prefix', '').'images', function (Blueprint $table) {
                $table->text('tags')->nullable();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        if (in_array('images', config('cms.active-core-modules'))) {
            Schema::table(config('cms.db-prefix', '').'images', function ($table) {
                $table->dropColumn('tags');
            });
        }
    }
}
