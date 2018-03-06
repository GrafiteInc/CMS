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
        Schema::table(config('cabin.db-prefix', '').'pages', function (Blueprint $table) {
            $table->text('blocks')->nullable();
        });

        Schema::table(config('cabin.db-prefix', '').'blogs', function (Blueprint $table) {
            $table->text('blocks')->nullable();
        });

        Schema::table(config('cabin.db-prefix', '').'events', function (Blueprint $table) {
            $table->text('blocks')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table(config('cabin.db-prefix', '').'pages', function ($table) {
            $table->dropColumn('blocks');
        });

        Schema::table(config('cabin.db-prefix', '').'blogs', function ($table) {
            $table->dropColumn('blocks');
        });

        Schema::table(config('cabin.db-prefix', '').'events', function ($table) {
            $table->dropColumn('blocks');
        });
    }
}
