<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLinksTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (! Schema::hasTable('links')) {
            Schema::create('links', function(Blueprint $table)
            {
                $table->increments('id');
                $table->string('name');
                $table->boolean('external')->default(0);
                $table->integer('page_id');
                $table->integer('menu_id');
                $table->string('external_url')->nullable();
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
        Schema::drop('links');
    }

}
