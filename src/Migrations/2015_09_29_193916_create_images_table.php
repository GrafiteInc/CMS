<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateImagesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create(config('cms.db-prefix', '').'images', function (Blueprint $table) {
            $table->increments('id');
            $table->string('location');
            $table->string('name')->nullable();
            $table->string('original_name');
            $table->string('storage_location')->default('local');
            $table->string('alt_tag')->nullable();
            $table->string('title_tag')->nullable();
            $table->boolean('is_published')->default(0);
            $table->nullableTimestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop(config('cms.db-prefix', '').'images');
    }
}
