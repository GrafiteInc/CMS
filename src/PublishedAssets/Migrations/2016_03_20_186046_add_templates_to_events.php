<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddTemplatesToEvents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(config('quarx.db-prefix', '').'events', function (Blueprint $table) {
            $table->string('template')->default('show');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table(config('quarx.db-prefix', '').'events', function ($table) {
            $table->dropColumn('template');
        });
    }
}
