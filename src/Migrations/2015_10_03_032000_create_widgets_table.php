<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWidgetsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (! Schema::hasTable('widgets')) {
            Schema::create('widgets', function(Blueprint $table)
            {
                $table->increments('id');
                $table->string('name');
                $table->string('uuid');
                $table->text('content')->nullable();
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
        Schema::drop('widgets');
    }

}
