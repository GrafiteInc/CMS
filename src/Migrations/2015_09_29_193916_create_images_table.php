<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImagesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (! Schema::hasTable('images')) {
            Schema::create('images', function(Blueprint $table)
            {
                $table->increments('id');
                $table->string('location');
                $table->string('name')->nullable();
                $table->string('original_name');
                $table->string('alt_tag')->nullable();
                $table->string('title_tag')->nullable();
                $table->integer('is_published')->default(0);
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('images');
    }

}
