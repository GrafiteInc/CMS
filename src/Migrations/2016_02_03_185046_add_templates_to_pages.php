<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddTemplatesToPages extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table(config('cms.db-prefix', '').'pages', function (Blueprint $table) {
            $table->string('template')->default('show');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table(config('cms.db-prefix', '').'pages', function ($table) {
            $table->dropColumn('template');
        });
    }
}
