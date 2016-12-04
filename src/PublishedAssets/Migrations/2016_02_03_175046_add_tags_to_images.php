<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddTagsToImages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(config('quarx.db-prefix', '').'images', function (Blueprint $table) {
            $table->text('tags')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table(config('quarx.db-prefix', '').'images', function ($table) {
            $table->dropColumn('tags');
        });
    }
}
