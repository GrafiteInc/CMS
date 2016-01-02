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
        if (! Schema::hasTable('blogs')) {
            Schema::create('blogs', function(Blueprint $table)
            {
                $table->increments('id');
                $table->string('title');
                $table->text('entry')->nullable();
                $table->string('tags')->nullable();
                $table->integer('is_published')->default(0);
                $table->string('url');
                $table->timestamps();
            });
        };
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
