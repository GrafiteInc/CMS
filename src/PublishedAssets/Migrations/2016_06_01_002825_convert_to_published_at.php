<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class ConvertToPublishedAt extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pages', function (Blueprint $table) {
            $table->dateTime('published_at')->nullable();
        });

        Schema::table('blogs', function (Blueprint $table) {
            $table->dateTime('published_at')->nullable();
        });

        Schema::table('events', function (Blueprint $table) {
            $table->dateTime('published_at')->nullable();
        });

        Schema::table('faqs', function (Blueprint $table) {
            $table->dateTime('published_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pages', function ($table) {
            $table->dropColumn('published_at');
        });

        Schema::table('blogs', function ($table) {
            $table->dropColumn('published_at');
        });

        Schema::table('events', function ($table) {
            $table->dropColumn('published_at');
        });

        Schema::table('faqs', function ($table) {
            $table->dropColumn('published_at');
        });
    }
}
