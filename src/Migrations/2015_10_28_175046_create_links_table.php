<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLinksTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create(config('cms.db-prefix', '').'links', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->boolean('external')->default(0);
            $table->integer('page_id');
            $table->integer('menu_id');
            $table->string('external_url')->nullable();
            $table->nullableTimestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop(config('cms.db-prefix', '').'links');
    }
}
