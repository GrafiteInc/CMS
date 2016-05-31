<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blogs', function(Blueprint $table)
        {
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
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('blogs');
    }

}
