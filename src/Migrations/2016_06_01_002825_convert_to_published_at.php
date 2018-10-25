<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class ConvertToPublishedAt extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table(config('cms.db-prefix', '').'pages', function (Blueprint $table) {
            $table->dateTime('published_at')->nullable();
        });

        Schema::table(config('cms.db-prefix', '').'blogs', function (Blueprint $table) {
            $table->dateTime('published_at')->nullable();
        });

        Schema::table(config('cms.db-prefix', '').'events', function (Blueprint $table) {
            $table->dateTime('published_at')->nullable();
        });

        Schema::table(config('cms.db-prefix', '').'faqs', function (Blueprint $table) {
            $table->dateTime('published_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table(config('cms.db-prefix', '').'pages', function ($table) {
            $table->dropColumn('published_at');
        });

        Schema::table(config('cms.db-prefix', '').'blogs', function ($table) {
            $table->dropColumn('published_at');
        });

        Schema::table(config('cms.db-prefix', '').'events', function ($table) {
            $table->dropColumn('published_at');
        });

        Schema::table(config('cms.db-prefix', '').'faqs', function ($table) {
            $table->dropColumn('published_at');
        });
    }
}
