<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (! Schema::hasTable('files')) {
            Schema::create('files', function(Blueprint $table)
            {
                $table->increments('id');
                $table->string('name');
                $table->string('location');
                $table->integer('user');
                $table->string('tags')->nullable();
                $table->text('details')->nullable();
                $table->string('mime');
                $table->string('size');
                $table->integer('published');
                $table->integer('order');
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
        Schema::drop('files');
    }

}
