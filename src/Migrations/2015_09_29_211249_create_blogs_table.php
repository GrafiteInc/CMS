<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBlogsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create(config('cms.db-prefix', '').'blogs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->text('entry')->nullable();
            $table->string('tags')->nullable();
            $table->boolean('is_published')->default(0);
            $table->string('seo_description')->nullable();
            $table->string('seo_keywords')->nullable();
            $table->string('url');
            $table->nullableTimestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop(config('cms.db-prefix', '').'blogs');
    }
}
