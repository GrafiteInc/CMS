<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create(config('cms.db-prefix', '').'events', function (Blueprint $table) {
            $table->increments('id');
            $table->date('start_date');
            $table->date('end_date');
            $table->string('title');
            $table->text('details');
            $table->string('seo_description')->nullable();
            $table->string('seo_keywords')->nullable();
            $table->boolean('is_published')->default(0);
            $table->nullableTimestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop(config('cms.db-prefix', '').'events');
    }
}
